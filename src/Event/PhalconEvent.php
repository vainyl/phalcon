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

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Event\EventInterface;
use Vainyl\Phalcon\Exception\NonCancelableEventException;

/**
 * Class PhalconEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEvent extends AbstractIdentifiable implements EventInterface
{
    private $name;

    private $source;

    private $data;

    private $stopped;

    private $cancelable;

    /**
     * PhalconEvent constructor.
     *
     * @param string $name
     * @param mixed  $source
     * @param mixed  $data
     * @param bool   $cancelable
     */
    public function __construct($name, $source, $data, $cancelable = true)
    {
        $this->name = $name;
        $this->source = $source;
        $this->data = $data;
        $this->cancelable = $cancelable;
        $this->stopped = false;
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @inheritDoc
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isStopped()
    {
        return $this->stopped;
    }

    /**
     * @inheritDoc
     */
    public function setStopped($stopped)
    {
        $this->stopped = $stopped;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isCancelable()
    {
        return $this->getCancelable();
    }

    /**
     * @return boolean
     */
    public function getCancelable()
    {
        return $this->cancelable;
    }

    /**
     * @inheritDoc
     */
    public function setCancelable($cancelable)
    {
        $this->cancelable = $cancelable;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function stop()
    {
        if (false === $this->cancelable) {
            throw new NonCancelableEventException($this);
        }
        $this->stopped = true;

        return $this;
    }
}
