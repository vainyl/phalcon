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

use Vainyl\Event\EventDispatcherInterface;
use Vainyl\Event\Exception\AbstractDispatcherException;

/**
 * Class UnsupportedPrioritiesException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedPrioritiesException extends AbstractDispatcherException
{
    /**
     * UnsupportedPrioritiesException constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher, 'Priorities are not supported in Phalcon bridge');
    }
}
