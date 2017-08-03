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

namespace Vainyl\Phalcon\Container;

use Phalcon\Di\InjectionAwareInterface as PhalconDiAwareInterface;
use Psr\Container\ContainerInterface;
use Vainyl\Phalcon\Exception\UnsupportedDiCallException;
use \Phalcon\Di\ServiceInterface as PhalconServiceInterface;
use \Phalcon\DiInterface as PhalconDiInterface;

/**
 * Class PhalconContainerAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconContainerAdapter implements PhalconDiInterface, ContainerInterface
{
    private $container;

    /**
     * PhalconContainerAdapter constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function set($name, $definition, $shared = false)
    {
        $this->container->set($name, $definition);
    }

    /**
     * @inheritDoc
     */
    public function setShared($name, $definition)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function remove($name)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function attempt($name, $definition, $shared = false)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function get($name, $parameters = null)
    {
        $result = $this->container->get($name);

        if ($result instanceof PhalconDiAwareInterface) {
            $result->setDI($this);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getShared($name, $parameters = null)
    {
        return $this->get($name, $parameters);
    }

    /**
     * @inheritDoc
     */
    public function setRaw($name, PhalconServiceInterface $rawDefinition)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function getRaw($name)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function getService($name)
    {
        return $this->get($name);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->container->has($name);
    }

    /**
     * @inheritDoc
     */
    public function wasFreshInstance()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getServices()
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public static function setDefault(PhalconDiInterface $dependencyInjector)
    {
        throw new UnsupportedDiCallException($dependencyInjector, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public static function getDefault()
    {
    }

    /**
     * @inheritDoc
     */
    public static function reset()
    {
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }
}
