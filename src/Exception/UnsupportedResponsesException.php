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

use Vainyl\Event\EventDispatcherInterface;
use Vainyl\Event\Exception\AbstractDispatcherException;

/**
 * Class UnsupportedResponsesException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedResponsesException extends AbstractDispatcherException
{
    /**
     * UnsupportedResponsesException constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher, 'Response collecting is not supported in Phalcon bridge');
    }
}
