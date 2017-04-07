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
namespace Vainyl\Phalcon\Http\Cookie\Factory;

use Vain\Core\Http\Cookie\Factory\CookieFactoryInterface;
use Vain\Core\Http\Cookie\VainCookieInterface;
use Vainyl\Phalcon\Http\Cookie\PhalconCookie;

/**
 * Class PhalconCookieFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCookieFactory implements CookieFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createCookie(
        string $name,
        string $value,
        \DateTimeInterface $expiryDate = null,
        string $path = '/',
        string $domain = null,
        bool $secure = false,
        bool $httpOnly = false
    ) : VainCookieInterface
    {
        return new PhalconCookie($name, $value, $expiryDate, $path, $domain, $secure, $httpOnly);
    }
}
