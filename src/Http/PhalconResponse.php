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

namespace Vainyl\Phalcon\Http;

use Phalcon\Http\ResponseInterface;
use Vainyl\Http\Decorator\AbstractResponseDecorator;
use Vainyl\Http\Response;
use Vainyl\Phalcon\Exception\BadRedirectCodeException;
use Vainyl\Phalcon\Exception\UnsupportedResponseCallException;

/**
 * Class PhalconResponse
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconResponse extends AbstractResponseDecorator implements ResponseInterface
{
    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null)
    {
        return $this->withStatus($code, $message);
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value)
    {
        return $this->withHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header)
    {
        list ($headerName, $headerValue) = explode(':', $header);

        return $this->withHeader($headerName, $headerValue);
    }

    /**
     * @inheritDoc
     */
    public function setContentLength($contentLength)
    {
        return $this->withHeader(Response::HEADER_CONTENT_LENGTH, $contentLength);
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        $cloned = clone $datetime;
        $cloned->setTimezone(new \DateTimeZone("UTC"));

        return $this->withHeader(Response::HEADER_EXPIRES, $datetime->format("D, d M Y H:i:s") . " GMT");
    }

    /**
     * @inheritDoc
     */
    public function setNotModified()
    {
        return $this->withStatus(304, 'Not modified');
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null)
    {
        if (null === $charset) {
            $this->withHeader(Response::HEADER_CONTENT_TYPE, $contentType);
        } else {
            $this->withHeader(Response::HEADER_CONTENT_TYPE, sprintf('%s";charset=%s"', $contentType, $charset));
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, $externalRedirect = false, $statusCode = 302)
    {
        if ($statusCode < 300 || $statusCode > 308) {
            throw new BadRedirectCodeException($this, $statusCode);
        }

        return $this
            ->withStatus($statusCode)
            ->withHeader(Response::HEADER_LOCATION, $location);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        $this->getBody()->write($content);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content)
    {
        throw new UnsupportedResponseCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content)
    {
        $this->getBody()->write($content);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders()
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sendCookies()
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getBody()->getContents();
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders()
    {
        $copy = clone $this;
        foreach ($this->getHeaders() as $name => $header) {
            $copy = $copy->withoutHeader($name);
        }

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null)
    {
        $response = $this->resetHeaders();

        $basePath = $attachmentName;

        if ('string' !== gettype($attachmentName)) {
            $basePath = basename($attachmentName);
        }

        return $response
            ->withHeader(Response::HEADER_CONTENT_DESCRIPTION, 'File Transfer')
            ->withHeader(Response::HEADER_CONTENT_TYPE, 'application/octet-stream')
            ->withHeader(Response::HEADER_CONTENT_DISPOSITION, sprintf('attachment; filename=%s', $basePath))
            ->withHeader(Response::HEADER_CONTENT_TRANSFER_ENCODING, 'binary')
            ->getBody()
            ->write(readfile($filePath));
    }
}
