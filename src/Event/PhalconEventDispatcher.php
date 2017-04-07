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
namespace Vainyl\Phalcon\Event;

use Phalcon\Events\ManagerInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Event\EventDispatcherInterface;
use Vainyl\Event\EventInterface;
use Vainyl\Phalcon\Exception\UnsupportedPrioritiesException;
use Vainyl\Phalcon\Exception\UnsupportedResponsesException;

/**
 * Class PhalconEventDispatcher
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEventDispatcher extends AbstractIdentifiable implements ManagerInterface, EventDispatcherInterface
{
    private $eventDispatcher;

    /**
     * PhalconEventDispatcher constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritDoc
     */
    public function attach($eventType, $handler, $priority = 100)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detach($eventType, $handler)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detachAll($type = null)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(EventInterface $event) : EventDispatcherInterface
    {
        $this->eventDispatcher->dispatch($event);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function fire($eventType, $source, $data = null)
    {
        return $this->dispatch(new PhalconEvent($eventType, $source, $data));
    }

    /**
     * @inheritDoc
     */
    public function getListeners($type)
    {
        return $this->getHandlers((string)$type);
    }

    /**
     * @inheritDoc
     */
    public function getHandlers($eventName) : array
    {
        return [];
    }

    /**
     * @param bool $enablePriorities
     *
     * @throws UnsupportedPrioritiesException
     */
    public function enablePriorities($enablePriorities)
    {
        throw new UnsupportedPrioritiesException($this);
    }

    /**
     * @return bool
     */
    public function arePrioritiesEnabled()
    {
        return false;
    }

    /**
     * @param bool $collect
     *
     * @throws UnsupportedResponsesException
     */
    public function collectResponses($collect)
    {
        throw new UnsupportedResponsesException($this);
    }

    /**
     * @return bool
     */
    public function isCollecting()
    {
        return false;
    }

    /**
     * @throws UnsupportedResponsesException
     */
    public function getResponses()
    {
        throw new UnsupportedResponsesException($this);
    }
}
