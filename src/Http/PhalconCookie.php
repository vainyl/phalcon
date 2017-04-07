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
namespace Vainyl\Phalcon\Http\Cookie;

use Phalcon\Http\CookieInterface;
use Vainyl\Http\Cookie;
use Vainyl\Phalcon\Exception\UnsupportedCookieCallException;

/**
 * Class PhalconCookie
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCookie extends Cookie implements CookieInterface
{
    /**
     * @inheritDoc
     */
    public function getValue($filters = null, $defaultValue = null) : string
    {
        return parent::getValue();
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        setcookie(
            $this->getName(),
            $this->getValue(),
            $this->getExpiryDate()->getTimestamp(),
            $this->getPath(),
            $this->getDomain(),
            $this->isSecure(),
            $this->isHttpOnly()
        );

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function delete()
    {
        throw new UnsupportedCookieCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function useEncryption($useEncryption)
    {
        throw new UnsupportedCookieCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function isUsingEncryption()
    {
        throw new UnsupportedCookieCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function setExpiration($expire)
    {
        return $this->setExpiryDate(new \DateTime($expire));
    }

    /**
     * @inheritDoc
     */
    public function getExpiration()
    {
        return $this->getExpiryDate()->getTimestamp();
    }

    /**
     * @inheritDoc
     */
    public function getSecure()
    {
        return $this->isSecure();
    }

    /**
     * @inheritDoc
     */
    public function getHttpOnly()
    {
        return $this->isHttpOnly();
    }
}
