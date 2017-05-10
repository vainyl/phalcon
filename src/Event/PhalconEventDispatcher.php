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
use Vainyl\Event\Decorator\AbstractEventDispatcherDecorator;
use Vainyl\Phalcon\Exception\UnsupportedDispatcherCallException;

/**
 * Class PhalconEventDispatcher
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEventDispatcher extends AbstractEventDispatcherDecorator implements ManagerInterface
{
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
    public function getHandlers($eventName): array
    {
        return [];
    }

    /**
     * @param bool $enablePriorities
     *
     * @throws UnsupportedDispatcherCallException
     */
    public function enablePriorities($enablePriorities)
    {
        throw new UnsupportedDispatcherCallException($this, __METHOD__);
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
     * @throws UnsupportedDispatcherCallException
     */
    public function collectResponses($collect)
    {
        throw new UnsupportedDispatcherCallException($this, __METHOD__);
    }

    /**
     * @return bool
     */
    public function isCollecting()
    {
        return false;
    }

    /**
     * @throws UnsupportedDispatcherCallException
     */
    public function getResponses()
    {
        throw new UnsupportedDispatcherCallException($this, __METHOD__);
    }
}
