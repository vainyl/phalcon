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
declare(strict_types=1);

namespace Vainyl\Phalcon\Http;

use Phalcon\FilterInterface;
use Phalcon\Http\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Http\Factory\CookieFactoryInterface;
use Vainyl\Http\Factory\HeaderFactoryInterface;
use Vainyl\Http\ServerRequest;

/**
 * Class PhalconRequest
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconRequest extends ServerRequest implements RequestInterface
{
    private $filter;

    /**
     * ServerRequest constructor.
     *
     * @param HeaderFactoryInterface $headerFactory
     * @param \ArrayAccess           $headerStorage
     * @param string                 $method
     * @param UriInterface           $uri
     * @param StreamInterface        $stream
     * @param \ArrayAccess           $cookieStorage
     * @param \ArrayAccess           $fileStorage
     * @param CookieFactoryInterface $cookieFactory
     * @param array                  $serverParams
     * @param array                  $queryParams
     * @param array                  $attributes
     * @param array                  $parsedBody
     * @param string                 $protocol
     */
    public function __construct(
        FilterInterface $filter,
        HeaderFactoryInterface $headerFactory,
        \ArrayAccess $headerStorage,
        string $method,
        UriInterface $uri,
        StreamInterface $stream,
        \ArrayAccess $cookieStorage,
        \ArrayAccess $fileStorage,
        CookieFactoryInterface $cookieFactory,
        array $serverParams,
        array $queryParams,
        array $attributes,
        array $parsedBody,
        string $protocol
    ) {
        $this->filter = $filter;
        parent::__construct(
            $headerFactory,
            $headerStorage,
            $method,
            $uri,
            $stream,
            $cookieStorage,
            $fileStorage,
            $cookieFactory,
            $serverParams,
            $queryParams,
            $attributes,
            $parsedBody,
            $protocol
        );
    }

    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getQuery($name, $filters, $defaultValue);
    }

    /**
     * @param array  $data
     * @param string $name
     * @param array  $filters
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    protected function getRequestValue(array $data, $name, $filters, $defaultValue)
    {
        if (null === $name) {
            return $data;
        }

        if (false === array_key_exists($name, $data)) {
            return $defaultValue;
        }

        $value = $data[$name];

        if (null === $filters) {
            return $value;
        }

        return $this->filter->sanitize($value, $filters);
    }

    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getRequestValue($this->getParsedBody(), $name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getRequestValue($this->getQueryParams(), $name, $filters, $defaultValue);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasQueryParam(string $name): bool
    {
        return array_key_exists($name, $this->getQueryParams());
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasBodyParam(string $name): bool
    {
        return array_key_exists($name, $this->getParsedBody());
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        if (false === $this->hasHeader(self::HEADER_CONTENT_TYPE)) {
            return '';
        }

        return $this->getHeaderLine(self::HEADER_CONTENT_TYPE);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasServer($name)
    {
        return array_key_exists($name, $this->getServerParams());
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getServer($name, $default = ''): string
    {
        if (false === array_key_exists($name, $this->getServerParams())) {
            return $default;
        }

        return $this->getServerParams()[$name];
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return ($this->hasQueryParam($name) || $this->hasBodyParam($name));
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name)
    {
        return ($this->isPost() && $this->hasBodyParam($name));
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name)
    {
        return ($this->isPut() && $this->hasBodyParam($name));
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name)
    {
        return $this->hasQueryParam($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax()
    {
        return 'XMLHttpRequest' === $this->getServer('HTTP_X_REQUESTED_WITH');
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested()
    {
        return ($this->hasServer('HTTP_SOAPACTION') || strstr('application/soap+xml', $this->getContentType()));
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        return $this->getContents();
    }

    /**
     * @inheritDoc
     */
    public function getJsonRawBody($mode)
    {
        return json_decode($this->getContents(), $mode);
    }

    /**
     * @inheritDoc
     */
    public function getClientAddress($trustForwardedHeader = false)
    {
        return $this->getServer('REMOTE_ADDR');
    }

    /**
     * @inheritDoc
     */
    public function isMethod($methods, $strict = false)
    {
        switch (true) {
            case is_string($methods):
                return ($methods === $this->getMethod());
                break;
            case is_array($methods):
                foreach ($methods as $method) {
                    if ($method === $this->getMethod()) {
                        return true;
                    }
                }

                return false;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false)
    {
        $count = 0;
        foreach ($this->getUploadedFiles() as $file) {
            if (UPLOAD_ERR_OK !== $file->getError()) {
                continue;
            }
            $count++;
        }

        return $count;
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer()
    {
        return $this->getServer('HTTP_REFERER', '');
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent()
    {
        if (false === $this->hasHeader('HTTP_ACCEPT')) {
            return [];
        }

        return $this->getHeader('HTTP_ACCEPT');
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept()
    {
        $contents = $this->getAcceptableContent();

        return reset($contents);
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets()
    {
        if (false === $this->hasHeader('HTTP_ACCEPT_CHARSET')) {
            return [];
        }

        return $this->getHeader('HTTP_ACCEPT_CHARSET');
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset()
    {
        $clientCharsets = $this->getClientCharsets();

        return reset($clientCharsets);
    }

    /**
     * @inheritDoc
     */
    public function getLanguages()
    {
        if (false === $this->hasHeader('HTTP_ACCEPT_LANGUAGE')) {
            return [];
        }

        return $this->getHeader('HTTP_ACCEPT_LANGUAGE');
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage()
    {
        $languages = $this->getLanguages();

        return reset($languages);
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth()
    {
        return ['username' => $this->getServer('PHP_AUTH_USER'), 'password' => $this->getServer('PHP_AUTH_PASSWORD')];
    }

    /**
     * @param bool $onlySuccessful
     *
     * @return \ArrayAccess
     */
    public function getUploadedFiles($onlySuccessful = null): \ArrayAccess
    {
        return parent::getUploadedFiles();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getPort()
    {
        return $this->getUri()->getPort();
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        return $this->getUri()->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest()
    {
        return 'https' === $this->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress()
    {
        return $this->getServer('SERVER_ADDR');
    }

    /**
     * @inheritDoc
     */
    public function getServerName()
    {
        return $this->getServer('SERVER_NAME');
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost()
    {
        return $this->getServer('HTTP_HOST');
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        return $this->getServer('USER_AGENT');
    }

    /**
     * @inheritDoc
     */
    public function isPost()
    {
        return 'post' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isGet()
    {
        return 'get' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isPut()
    {
        return 'put' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isHead()
    {
        return 'head' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isDelete()
    {
        return 'delete' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isOptions()
    {
        return 'options' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isPurge()
    {
        return 'purge' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isTrace()
    {
        return 'trace' === $this->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function isConnect()
    {
        return 'connect' === $this->getMethod();
    }
}
