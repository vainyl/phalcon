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

use Phalcon\Http\CookieInterface;
use Vainyl\Http\Cookie;
use Vainyl\Phalcon\Exception\UnsupportedCookieCallException;
use Vainyl\Time\Factory\TimeFactoryInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class PhalconCookie
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCookie extends Cookie implements CookieInterface
{
    private $timeFactory;

    /**
     * PhalconCookie constructor.
     *
     * @param TimeFactoryInterface $timeFactory
     * @param string               $name
     * @param string               $value
     * @param TimeInterface|null   $expiryDate
     * @param string               $path
     * @param null                 $domain
     * @param bool                 $secure
     * @param bool                 $httpOnly
     */
    public function __construct(
        TimeFactoryInterface $timeFactory,
        $name,
        $value,
        TimeInterface $expiryDate = null,
        $path = '/',
        $domain = null,
        $secure = false,
        $httpOnly = false
    ) {
        $this->timeFactory = $timeFactory;
        parent::__construct($name, $value, $expiryDate, $path, $domain, $secure, $httpOnly);
    }

    /**
     * @inheritDoc
     */
    public function getValue($filters = null, $defaultValue = null): string
    {
        return parent::getValue();
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
        return $this->withExpiryDate($this->timeFactory->createFromString((string)$expire));
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

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        return $this->withValue($value);
    }

    /**
     * @inheritDoc
     */
    public function setPath($path)
    {
        return $this->withPath($path);
    }

    /**
     * @inheritDoc
     */
    public function setDomain($domain)
    {
        return $this->withDomain($domain);
    }

    /**
     * @inheritDoc
     */
    public function setSecure($secure)
    {
        return $this->withSecure($secure);
    }

    /**
     * @inheritDoc
     */
    public function setHttpOnly($httpOnly)
    {
        return $this->withHttpOnly($httpOnly);
    }
}
