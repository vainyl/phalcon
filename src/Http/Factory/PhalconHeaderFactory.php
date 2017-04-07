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

namespace Vainyl\Phalcon\Http\Header\Factory;

use Vain\Core\Http\Header\Factory\HeaderFactoryInterface;
use Vain\Core\Http\Header\VainHeaderInterface;
use Vainyl\Phalcon\Http\Header\PhalconHeader;

/**
 * Class PhalconHeaderFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconHeaderFactory implements HeaderFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createHeader(string $name, $value) : VainHeaderInterface
    {
        $transformedValue = $value;
        if (false === is_array($value)) {
            $transformedValue = [$value];
        }

        return new PhalconHeader($name, $transformedValue);
    }
}
