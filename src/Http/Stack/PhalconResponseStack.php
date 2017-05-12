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

namespace Vainyl\Phalcon\Http\Stack;

use Phalcon\Http\ResponseInterface as PhalconResponseInterface;
use Psr\Http\Message\ResponseInterface;
use Vainyl\Http\Decorator\AbstractResponseDecorator;
use Vainyl\Http\Stack\ResponseStackInterface;

/**
 * Class PhalconResponseStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconResponseStack getMessage
 */
class PhalconResponseStack extends AbstractResponseDecorator implements PhalconResponseInterface, ResponseStackInterface
{
    /**
     * @inheritDoc
     */
    public function addResponse(ResponseInterface $vainResponse): ResponseStackInterface
    {
        $this->getMessage()->addResponse($vainResponse);

        return $this;
    }

    /**
     * @return PhalconResponseInterface
     */
    public function popResponse(): ResponseInterface
    {
        return $this->getMessage()->popResponse();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentResponse(): ResponseInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null)
    {
        $response = $this->getMessage()->popResponse()->setStatusCode($code, $message);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value)
    {
        $response = $this->getMessage()->popResponse()->setHeader($name, $value);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header)
    {
        $response = $this->getMessage()->popResponse()->setRawHeader($header);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders()
    {
        $response = $this->getMessage()->popResponse()->resetHeaders();
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        $response = $this->getMessage()->popResponse()->setExpires($datetime);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentLength($contentLength)
    {
        $response = $this->getMessage()->popResponse()->setContentLength($contentLength);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNotModified()
    {
        $response = $this->getMessage()->popResponse()->setNotModified();
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null)
    {
        $response = $this->getMessage()->popResponse()->setContentType($contentType);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, $externalRedirect = false, $statusCode = 302)
    {
        $response = $this->getMessage()->popResponse()->redirect($location, $externalRedirect, $statusCode);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        $response = $this->getMessage()->popResponse()->setContent($content);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content)
    {
        $response = $this->getMessage()->popResponse()->setJsonContent($content);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content)
    {
        $response = $this->getMessage()->popResponse()->appendContent($content);
        $this->getMessage()->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getMessage()->getCurrentResponse()->getContent();
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders()
    {
        return $this->getMessage()->getCurrentResponse()->sendHeaders();
    }

    /**
     * @inheritDoc
     */
    public function sendCookies()
    {
        return $this->getMessage()->getCurrentResponse()->sendCookies();
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        return $this->getMessage()->getCurrentResponse()->send();
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null)
    {
        $response = $this->getMessage()->popResponse()->setFileToSend($filePath, $attachmentName);
        $this->getMessage()->addResponse($response);

        return $this;
    }
}
