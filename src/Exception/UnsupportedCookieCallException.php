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

namespace Vainyl\Phalcon\Exception;

use Vainyl\Http\CookieInterface;
use Vainyl\Http\Exception\AbstractCookieException;

/**
 * Class UnsupportedCookieCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedCookieCallException extends AbstractCookieException
{
    /**
     * UnsupportedCookieCallException constructor.
     *
     * @param CookieInterface $cookie
     * @param string          $method
     */
    public function __construct(CookieInterface $cookie, $method)
    {
        parent::__construct($cookie, sprintf('Call to method %s on cookie object is not supported', $method));
    }
}
