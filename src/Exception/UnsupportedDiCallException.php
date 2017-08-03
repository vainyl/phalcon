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

use Psr\Container\ContainerInterface;
use Vainyl\Core\Exception\AbstractContainerException;

/**
 * Class UnsupportedDiCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedDiCallException extends AbstractContainerException
{
    /**
     * UnsupportedDiCallException constructor.
     *
     * @param ContainerInterface $container
     * @param string             $method
     */
    public function __construct(ContainerInterface $container, $method)
    {
        parent::__construct($container, sprintf('Call to method %s on container is not supported', $method));
    }
}
