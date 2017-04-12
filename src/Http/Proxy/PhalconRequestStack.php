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

/**
 * Class PhalconRequestStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconRequestStack extends RequestStack implements RequestInterface
{
    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getPost($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getQuery($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->has($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->hasPost($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->hasPut($name);
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->hasQuery($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isAjax();
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isSoapRequested();
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getRawBody();
    }

    /**
     * @inheritDoc
     */
    public function getJsonRawBody($mode)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getJsonRawBody($mode);
    }

    /**
     * @inheritDoc
     */
    public function getClientAddress($trustForwardedHeader = false)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getClientAddress($trustForwardedHeader);
    }

    /**
     * @inheritDoc
     */
    public function isMethod($methods, $strict = false)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isMethod($methods, $strict);
    }

    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->hasFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getHTTPReferer();
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getAcceptableContent();
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getBestAccept();
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getClientCharsets();
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getBestCharset();
    }

    /**
     * @inheritDoc
     */
    public function getLanguages()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getLanguages();
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getBestLanguage();
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getBasicAuth();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getDigestAuth();
    }

    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $default = null)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->get($name, $filters, $default);
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles($onlySuccessFul = true)
    {
        return $this->getCurrentMessage()->getUploadedFiles($onlySuccessFul);
    }

    /**
     * @inheritDoc
     */
    public function getPort()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getPort();
    }

    /**
     * @inheritDoc
     */
    public function getServer($name)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getServer($name);
    }

    /**
     * @inheritDoc
     */
    public function hasServer($name)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->hasServer($name);
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isSecureRequest();
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getServerAddress();
    }

    /**
     * @inheritDoc
     */
    public function getServerName()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getServerName();
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getHttpHost();
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->getUserAgent();
    }

    /**
     * @inheritDoc
     */
    public function isPost()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isPost();
    }

    /**
     * @inheritDoc
     */
    public function isGet()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isGet();
    }

    /**
     * @inheritDoc
     */
    public function isPut()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isPut();
    }

    /**
     * @inheritDoc
     */
    public function isHead()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isHead();
    }

    /**
     * @inheritDoc
     */
    public function isDelete()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isDelete();
    }

    /**
     * @inheritDoc
     */
    public function isOptions()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isOptions();
    }

    /**
     * @inheritDoc
     */
    public function isPurge()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isPurge();
    }

    /**
     * @inheritDoc
     */
    public function isTrace()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isTrace();
    }

    /**
     * @inheritDoc
     */
    public function isConnect()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getCurrentMessage()->isConnect();
    }
}
