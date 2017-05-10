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

use Phalcon\Http\RequestInterface;
use Vainyl\Http\Proxy\RequestStack;
use Vainyl\Phalcon\Http\PhalconRequest;

/**
 * Class PhalconRequestStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconRequest getCurrentRequest
 */
class PhalconRequestStack extends RequestStack implements RequestInterface
{
    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getCurrentRequest()->getPost($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getCurrentRequest()->getQuery($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->getCurrentRequest()->has($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name)
    {
        return $this->getCurrentRequest()->hasPost($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name)
    {
        return $this->getCurrentRequest()->hasPut($name);
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name)
    {
        return $this->getCurrentRequest()->hasQuery($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax()
    {
        return $this->getCurrentRequest()->isAjax();
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested()
    {
        return $this->getCurrentRequest()->isSoapRequested();
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        return $this->getCurrentRequest()->getRawBody();
    }

    /**
     * @inheritDoc
     */
    public function getJsonRawBody($mode)
    {
        return $this->getCurrentRequest()->getJsonRawBody($mode);
    }

    /**
     * @inheritDoc
     */
    public function getClientAddress($trustForwardedHeader = false)
    {
        return $this->getCurrentRequest()->getClientAddress($trustForwardedHeader);
    }

    /**
     * @inheritDoc
     */
    public function isMethod($methods, $strict = false)
    {
        return $this->getCurrentRequest()->isMethod($methods, $strict);
    }

    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false)
    {
        return $this->getCurrentRequest()->hasFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer()
    {
        return $this->getCurrentRequest()->getHTTPReferer();
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent()
    {
        return $this->getCurrentRequest()->getAcceptableContent();
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept()
    {
        return $this->getCurrentRequest()->getBestAccept();
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets()
    {
        return $this->getCurrentRequest()->getClientCharsets();
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset()
    {
        return $this->getCurrentRequest()->getBestCharset();
    }

    /**
     * @inheritDoc
     */
    public function getLanguages()
    {
        return $this->getCurrentRequest()->getLanguages();
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage()
    {
        return $this->getCurrentRequest()->getBestLanguage();
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth()
    {
        return $this->getCurrentRequest()->getBasicAuth();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        return $this->getCurrentRequest()->getDigestAuth();
    }

    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $default = null)
    {
        return $this->getCurrentRequest()->get($name, $filters, $default);
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles($onlySuccessFul = true)
    {
        return $this->getCurrentRequest()->getUploadedFiles($onlySuccessFul);
    }

    /**
     * @inheritDoc
     */
    public function getPort()
    {
        return $this->getCurrentRequest()->getPort();
    }

    /**
     * @inheritDoc
     */
    public function getServer($name)
    {
        return $this->getCurrentRequest()->getServer($name);
    }

    /**
     * @inheritDoc
     */
    public function hasServer($name)
    {
        return $this->getCurrentRequest()->hasServer($name);
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        return $this->getCurrentRequest()->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest()
    {
        return $this->getCurrentRequest()->isSecureRequest();
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress()
    {
        return $this->getCurrentRequest()->getServerAddress();
    }

    /**
     * @inheritDoc
     */
    public function getServerName()
    {
        return $this->getCurrentRequest()->getServerName();
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost()
    {
        return $this->getCurrentRequest()->getHttpHost();
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        return $this->getCurrentRequest()->getUserAgent();
    }

    /**
     * @inheritDoc
     */
    public function isPost()
    {
        return $this->getCurrentRequest()->isPost();
    }

    /**
     * @inheritDoc
     */
    public function isGet()
    {
        return $this->getCurrentRequest()->isGet();
    }

    /**
     * @inheritDoc
     */
    public function isPut()
    {
        return $this->getCurrentRequest()->isPut();
    }

    /**
     * @inheritDoc
     */
    public function isHead()
    {
        return $this->getCurrentRequest()->isHead();
    }

    /**
     * @inheritDoc
     */
    public function isDelete()
    {
        return $this->getCurrentRequest()->isDelete();
    }

    /**
     * @inheritDoc
     */
    public function isOptions()
    {
        return $this->getCurrentRequest()->isOptions();
    }

    /**
     * @inheritDoc
     */
    public function isPurge()
    {
        return $this->getCurrentRequest()->isPurge();
    }

    /**
     * @inheritDoc
     */
    public function isTrace()
    {
        return $this->getCurrentRequest()->isTrace();
    }

    /**
     * @inheritDoc
     */
    public function isConnect()
    {
        return $this->getCurrentRequest()->isConnect();
    }
}
