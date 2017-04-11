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

namespace Vainyl\Phalcon\Http\Factory;

use Vainyl\Http\CookieInterface;
use Vainyl\Http\Factory\CookieFactoryInterface;
use Vainyl\Phalcon\Http\PhalconCookie;
use Vainyl\Time\Factory\TimeFactoryInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class PhalconCookieFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCookieFactory implements CookieFactoryInterface
{
    private $timeFactory;

    /**
     * PhalconCookieFactory constructor.
     *
     * @param TimeFactoryInterface $timeFactory
     */
    public function __construct(TimeFactoryInterface $timeFactory)
    {
        $this->timeFactory = $timeFactory;
    }

    /**
     * @inheritDoc
     */
    public function createCookie(
        string $name,
        string $value,
        TimeInterface $expiryDate = null,
        string $path = '/',
        string $domain = null,
        bool $secure = false,
        bool $httpOnly = false
    ): CookieInterface {
        return new PhalconCookie($this->timeFactory, $name, $value, $expiryDate, $path, $domain, $secure, $httpOnly);
    }
}
