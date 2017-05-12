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

use Phalcon\Http\RequestInterface as PhalconRequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Http\Decorator\AbstractServerRequestDecorator;
use Vainyl\Http\Stack\RequestStackInterface;

/**
 * Class PhalconRequestStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconRequestStack getMessage
 */
class PhalconRequestStack extends AbstractServerRequestDecorator implements PhalconRequestInterface, RequestStackInterface
{
    /**
     * @inheritDoc
     */
    public function addRequest(ServerRequestInterface $request): RequestStackInterface
    {
        $this->getMessage()->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function popRequest(): ServerRequestInterface
    {
        return $this->getMessage()->popRequest();
    }

    /**
     * @return PhalconRequestInterface
     */
    public function getCurrentRequest(): ServerRequestInterface
    {
        return $this->getMessage()->getCurrentRequest();
    }

    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getMessage()->getCurrentRequest()->getPost($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getMessage()->getCurrentRequest()->getQuery($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->getMessage()->getCurrentRequest()->has($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name)
    {
        return $this->getMessage()->getCurrentRequest()->hasPost($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name)
    {
        return $this->getMessage()->getCurrentRequest()->hasPut($name);
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name)
    {
        return $this->getMessage()->getCurrentRequest()->hasQuery($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax()
    {
        return $this->getMessage()->getCurrentRequest()->isAjax();
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested()
    {
        return $this->getMessage()->getCurrentRequest()->isSoapRequested();
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        return $this->getMessage()->getCurrentRequest()->getRawBody();
    }

    /**
     * @inheritDoc
     */
    public function getJsonRawBody($mode)
    {
        return $this->getMessage()->getCurrentRequest()->getJsonRawBody($mode);
    }

    /**
     * @inheritDoc
     */
    public function getClientAddress($trustForwardedHeader = false)
    {
        return $this->getMessage()->getCurrentRequest()->getClientAddress($trustForwardedHeader);
    }

    /**
     * @inheritDoc
     */
    public function isMethod($methods, $strict = false)
    {
        return $this->getMessage()->getCurrentRequest()->isMethod($methods, $strict);
    }

    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false)
    {
        return $this->getMessage()->getCurrentRequest()->hasFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer()
    {
        return $this->getMessage()->getCurrentRequest()->getHTTPReferer();
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent()
    {
        return $this->getMessage()->getCurrentRequest()->getAcceptableContent();
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept()
    {
        return $this->getMessage()->getCurrentRequest()->getBestAccept();
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets()
    {
        return $this->getMessage()->getCurrentRequest()->getClientCharsets();
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset()
    {
        return $this->getMessage()->getCurrentRequest()->getBestCharset();
    }

    /**
     * @inheritDoc
     */
    public function getLanguages()
    {
        return $this->getMessage()->getCurrentRequest()->getLanguages();
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage()
    {
        return $this->getMessage()->getCurrentRequest()->getBestLanguage();
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth()
    {
        return $this->getMessage()->getCurrentRequest()->getBasicAuth();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        return $this->getMessage()->getCurrentRequest()->getDigestAuth();
    }

    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $default = null)
    {
        return $this->getMessage()->getCurrentRequest()->get($name, $filters, $default);
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles($onlySuccessFul = true)
    {
        return $this->getMessage()->getCurrentRequest()->getUploadedFiles($onlySuccessFul);
    }

    /**
     * @inheritDoc
     */
    public function getPort()
    {
        return $this->getMessage()->getCurrentRequest()->getPort();
    }

    /**
     * @inheritDoc
     */
    public function getServer($name)
    {
        return $this->getMessage()->getCurrentRequest()->getServer($name);
    }

    /**
     * @inheritDoc
     */
    public function hasServer($name)
    {
        return $this->getMessage()->getCurrentRequest()->hasServer($name);
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        return $this->getMessage()->getCurrentRequest()->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest()
    {
        return $this->getMessage()->getCurrentRequest()->isSecureRequest();
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress()
    {
        return $this->getMessage()->getCurrentRequest()->getServerAddress();
    }

    /**
     * @inheritDoc
     */
    public function getServerName()
    {
        return $this->getMessage()->getCurrentRequest()->getServerName();
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost()
    {
        return $this->getMessage()->getCurrentRequest()->getHttpHost();
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        return $this->getMessage()->getCurrentRequest()->getUserAgent();
    }

    /**
     * @inheritDoc
     */
    public function isPost()
    {
        return $this->getMessage()->getCurrentRequest()->isPost();
    }

    /**
     * @inheritDoc
     */
    public function isGet()
    {
        return $this->getMessage()->getCurrentRequest()->isGet();
    }

    /**
     * @inheritDoc
     */
    public function isPut()
    {
        return $this->getMessage()->getCurrentRequest()->isPut();
    }

    /**
     * @inheritDoc
     */
    public function isHead()
    {
        return $this->getMessage()->getCurrentRequest()->isHead();
    }

    /**
     * @inheritDoc
     */
    public function isDelete()
    {
        return $this->getMessage()->getCurrentRequest()->isDelete();
    }

    /**
     * @inheritDoc
     */
    public function isOptions()
    {
        return $this->getMessage()->getCurrentRequest()->isOptions();
    }

    /**
     * @inheritDoc
     */
    public function isPurge()
    {
        return $this->getMessage()->getCurrentRequest()->isPurge();
    }

    /**
     * @inheritDoc
     */
    public function isTrace()
    {
        return $this->getMessage()->getCurrentRequest()->isTrace();
    }

    /**
     * @inheritDoc
     */
    public function isConnect()
    {
        return $this->getMessage()->getCurrentRequest()->isConnect();
    }
}
