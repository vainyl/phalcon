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
declare(strict_types = 1);

namespace Vainyl\Phalcon\Exception;

use Vain\Core\Http\Cookie\VainCookieInterface;
use Vain\Core\Exception\CookieException;

/**
 * Class UnsupportedCookieCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedCookieCallException extends CookieException
{
    /**
     * UnsupportedCookieCallException constructor.
     *
     * @param VainCookieInterface $cookie
     * @param string              $method
     */
    public function __construct(VainCookieInterface $cookie, $method)
    {
        parent::__construct($cookie, sprintf('Call to method %s on cookie object is not supported', $method));
    }
}
