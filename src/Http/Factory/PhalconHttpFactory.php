<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */

namespace Vainyl\Phalcon\Http\Factory;

use Phalcon\FilterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Http\AbstractMessage;
use Vainyl\Http\Factory\CookieFactoryInterface;
use Vainyl\Http\Factory\FileFactoryInterface;
use Vainyl\Http\Factory\HeaderFactoryInterface;
use Vainyl\Http\Factory\RequestFactoryInterface;
use Vainyl\Http\Factory\ResponseFactoryInterface;
use Vainyl\Http\Factory\UriFactoryInterface;
use Vainyl\Http\Provider\HeaderProviderInterface;
use Vainyl\Http\ResourceStream;
use Vainyl\Http\StringStream;
use Vainyl\Phalcon\Exception\UnknownFilesException;
use Vainyl\Phalcon\Exception\UnknownProtocolException;
use Vainyl\Phalcon\Exception\UnreachableFileException;
use Vainyl\Phalcon\Http\PhalconRequest;
use Vainyl\Phalcon\Http\PhalconResponse;

/**
 * Class PhalconHttpFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconHttpFactory implements RequestFactoryInterface, ResponseFactoryInterface
{
    private $filter;

    private $headerProvider;

    private $cookieFactory;

    private $headerFactory;

    private $uriFactory;

    private $fileFactory;

    private $headerStorage;

    private $cookieStorage;

    /**
     * PhalconHttpFactory constructor.
     *
     * @param FilterInterface         $phalconFilter
     * @param HeaderProviderInterface $headerProvider
     * @param CookieFactoryInterface  $cookieFactory
     * @param HeaderFactoryInterface  $headerFactory
     * @param UriFactoryInterface     $uriFactory
     * @param FileFactoryInterface    $fileFactory
     * @param \ArrayAccess            $headerStorage
     * @param \ArrayAccess            $cookieStorage
     */
    public function __construct(
        FilterInterface $phalconFilter,
        HeaderProviderInterface $headerProvider,
        CookieFactoryInterface $cookieFactory,
        HeaderFactoryInterface $headerFactory,
        UriFactoryInterface $uriFactory,
        FileFactoryInterface $fileFactory,
        \ArrayAccess $headerStorage,
        \ArrayAccess $cookieStorage
    ) {
        $this->filter = $phalconFilter;
        $this->headerProvider = $headerProvider;
        $this->cookieFactory = $cookieFactory;
        $this->headerFactory = $headerFactory;
        $this->uriFactory = $uriFactory;
        $this->fileFactory = $fileFactory;
        $this->headerStorage = $headerStorage;
        $this->cookieStorage = $cookieStorage;
    }

    /**
     * @inheritDoc
     */
    public function createRequestStream(string $source, string $mode): StreamInterface
    {
        return new StringStream($this->createStream($source, $mode)->getContents());
    }

    /**
     * @inheritDoc
     */
    public function createStream(string $source, string $mode): StreamInterface
    {
        if (false === ($resource = @fopen($source, $mode))) {
            throw new UnreachableFileException($source, $mode);
        }

        return new ResourceStream($resource, $mode);
    }

    /**
     * @param array  $array
     * @param string $element
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function extractKey(array $array, string $element, $default)
    {
        if (false === array_key_exists($element, $array)) {
            return $default;
        }

        return $array[$element];
    }

//    /**
//     * @inheritDoc
//     */
//    public function createUri(string $uri): UriInterface
//    {
//        if (false === ($explode = parse_url($uri))) {
//            throw new UnsupportedUriException($this, $uri);
//        }
//
//        $extractedParts = [];
//        foreach ([
//                     self::PARSE_URL_SCHEME   => '',
//                     self::PARSE_URL_USER     => '',
//                     self::PARSE_URL_PASS     => '',
//                     self::PARSE_URL_HOST     => '',
//                     self::PARSE_URL_PORT     => 0,
//                     self::PARSE_URL_PATH     => '',
//                     self::PARSE_URL_QUERY    => '',
//                     self::PARSE_URL_FRAGMENT => '',
//                 ] as $element => $default) {
//            $extractedParts[] = $this->extractKey($explode, $element, $default);
//        }
//
//        return $this->createUri()new Uri(...$extractedParts);
//    }

    /**
     * @param array $data
     *
     * @return array
     * @throws UnknownFilesException
     */
    protected function createFiles(array $data)
    {
        $files = [];
        foreach ($data as $key => $fileSpec) {
            switch (true) {
                case is_array($fileSpec) && array_key_exists('tmp_name', $fileSpec):
                    $files[$key] = $this->processFile(
                        $fileSpec['tmp_name'],
                        $fileSpec['size'],
                        $fileSpec['error'],
                        $fileSpec['name'],
                        $fileSpec['type']
                    );
                    break;
                case is_array($fileSpec):
                    $files[$key] = $this->createFiles($fileSpec);
                    break;
                default:
                    throw new UnknownFilesException($this, $key);
            }
        }

        return $files;
    }

    /**
     * @param string $tmpName
     * @param int    $size
     * @param int    $error
     * @param string $name
     * @param string $type
     *
     * @return UploadedFileInterface[]|UploadedFileInterface
     */
    protected function processFile($tmpName, $size, $error, $name, $type)
    {
        if (false === is_array($tmpName)) {
            return $this->fileFactory->createFile($tmpName, $size, $error, $name, $type);
        }
        $files = [];
        foreach (array_keys($tmpName) as $tmpFileName) {
            $files[$tmpFileName] = $this->processFile(
                $tmpFileName,
                $size[$tmpFileName],
                $error[$tmpFileName],
                $name[$tmpFileName],
                $type[$tmpFileName]
            );
        }

        return $files;
    }

    /**
     * @param string $protocol
     *
     * @return string mixed
     * @throws UnknownProtocolException
     */
    protected function transformProtocol($protocol)
    {
        $matches = [];
        preg_match('/HTTP\/([\d\.]*)/', $protocol, $matches);
        switch (count($matches)) {
            case 2:
                return $matches[1];
                break;
            default:
                throw new UnknownProtocolException($this, $protocol);
        }
    }

    /**
     * @param string $requestMethod
     * @param array  $get
     * @param array  $request
     *
     * @return array
     */
    protected function getQueryParams($requestMethod, array $get, array $request)
    {
        if ('get' === $requestMethod) {
            return $get;
        }

        return $request;
    }

    /**
     * @param string          $requestMethod
     * @param string          $contentType
     * @param StreamInterface $stream
     * @param array           $post
     *
     * @return array
     */
    protected function parseBody($requestMethod, $contentType, StreamInterface $stream, array $post)
    {
        if (false === in_array($requestMethod, ['post', 'put', 'patch'])) {
            return [];
        }

        if ('' === ($contents = $stream->getContents())) {
            return [];
        }

        switch ($contentType) {
            case AbstractMessage::CONTENT_TYPE_URL_ENCODED:
            case AbstractMessage::CONTENT_TYPE_FORM_DATA:
                if ($requestMethod === 'post') {
                    return $post;
                }
                $body = [];
                parse_str($contents, $body);

                return $body;
                break;
            case AbstractMessage::CONTENT_TYPE_APPLICATION_JSON:
                $body = json_decode($contents, true);

                return $body;
                break;
            default:
                return $post;
                break;
        }
    }

    /**
     * @inheritDoc
     */
    public function createFromGlobals()
    {
        $files = $this->createFiles($_FILES);
        $cookieStorage = clone $this->cookieStorage;
        foreach ($_COOKIE as $cookieName => $cookieValue) {
            $cookies[] = $this->cookieFactory->createCookie($cookieName, $cookieValue);
        }
        $headerStorage = clone $this->headerStorage;
        foreach ($this->headerProvider->getHeaders($_SERVER) as $headerName => $headerValue) {
            $headerStorage->offsetSet($headerName, $this->headerFactory->createHeader($headerName, $headerValue));
        }
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        $stream = $this->createRequestStream('php://input', 'r');
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        return new PhalconRequest(
            $this->filter,
            $_SERVER,
            $files,
            $this->getQueryParams($method, $_GET, $_REQUEST),
            [],
            $this->parseBody($method, $contentType, $stream, $_POST),
            $this->transformProtocol($_SERVER['SERVER_PROTOCOL']),
            $method,
            $this->uriFactory->createUri($_SERVER['REQUEST_URI']),
            $stream,
            $cookieStorage,
            $headerStorage
        );
    }

    /**
     * @inheritDoc
     */
    public function createRequest(
        array $serverParams,
        array $uploadedFiles,
        array $queryParams,
        array $attributes,
        array $parsedBody,
        string $protocol,
        string $method,
        UriInterface $uri,
        StreamInterface $stream,
        array $cookies,
        array $headers
    ): ServerRequestInterface {
        $cookieStorage = clone $this->cookieStorage;
        foreach ($_COOKIE as $cookieName => $cookieValue) {
            $cookies[] = $this->cookieFactory->createCookie($cookieName, $cookieValue);
        }
        $headerStorage = clone $this->headerStorage;
        foreach ($this->headerProvider->getHeaders($_SERVER) as $headerName => $headerValue) {
            $headerStorage->offsetSet($headerName, $this->headerFactory->createHeader($headerName, $headerValue));
        }

        return new PhalconRequest(
            $this->filter,
            $serverParams,
            $uploadedFiles,
            $queryParams,
            $attributes,
            $parsedBody,
            $protocol,
            $method,
            $uri,
            $stream,
            $cookieStorage,
            $headerStorage
        );
    }

    /**
     * @inheritDoc
     */
    public function createResponse(
        string $destinationStream,
        int $statusCode = 200,
        array $headersData = [],
        string $content = ''
    ): ResponseInterface {
        $headerStorage = clone $this->headerStorage;
        foreach ($this->headerProvider->getHeaders($_SERVER) as $headerName => $headerValue) {
            $headerStorage->offsetSet($headerName, $this->headerFactory->createHeader($headerName, $headerValue));
        }

        $stream = $this->createStream($destinationStream, 'w+');
        $stream->write($content);

        return new PhalconResponse($statusCode, $this->headerFactory, $stream, $headerStorage);
    }
}
