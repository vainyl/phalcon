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

namespace Vainyl\Phalcon\Http\Proxy;

use Phalcon\Http\ResponseInterface;
use Vainyl\Http\Proxy\ResponseStack;
use Vainyl\Phalcon\Http\PhalconResponse;

/**
 * Class PhalconResponseStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconResponse getCurrentResponse
 */
class PhalconResponseStack extends ResponseStack implements ResponseInterface
{
    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null)
    {
        $response = $this->popResponse()->setStatusCode($code, $message);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value)
    {
        $response = $this->popResponse()->setHeader($name, $value);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header)
    {
        $response = $this->popResponse()->setRawHeader($header);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders()
    {
        $response = $this->popResponse()->resetHeaders();
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        $response = $this->popResponse()->setExpires($datetime);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentLength($contentLength)
    {
        $response = $this->popResponse()->setContentLength($contentLength);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNotModified()
    {
        $response = $this->popResponse()->setNotModified();
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null)
    {
        $response = $this->popResponse()->setContentType($contentType);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, $externalRedirect = false, $statusCode = 302)
    {
        $response = $this->popResponse()->redirect($location, $externalRedirect, $statusCode);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        $response = $this->popResponse()->setContent($content);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content)
    {
        $response = $this->popResponse()->setJsonContent($content);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content)
    {
        $response = $this->popResponse()->appendContent($content);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getCurrentResponse()->getContent();
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders()
    {
        return $this->getCurrentResponse()->sendHeaders();
    }

    /**
     * @inheritDoc
     */
    public function sendCookies()
    {
        return $this->getCurrentResponse()->sendCookies();
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        return $this->getCurrentResponse()->send();
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null)
    {
        $response = $this->popResponse()->setFileToSend($filePath, $attachmentName);
        $this->addResponse($response);

        return $this;
    }
}
