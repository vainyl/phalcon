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

use Vainyl\Event\Exception\AbstractEventException;
use Vainyl\Phalcon\Event\PhalconEvent;

/**
 * Class NonCancelableEventException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NonCancelableEventException extends AbstractEventException
{
    /**
     * NonCancelableException constructor.
     *
     * @param PhalconEvent $event
     */
    public function __construct(PhalconEvent $event)
    {
        parent::__construct($event, 'Trying to stop event propagation on non-cancelable event');
    }
}
