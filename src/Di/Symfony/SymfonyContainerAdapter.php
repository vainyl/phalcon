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
namespace Vainyl\Phalcon\Di\Symfony;

use Phalcon\Di\InjectionAwareInterface as PhalconDiAwareInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Container as SymfonyContainer;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;
use Vainyl\Phalcon\Exception\UnsupportedDiCallException;
use \Phalcon\Di\ServiceInterface as PhalconServiceInterface;
use \Phalcon\DiInterface as PhalconDiInterface;

/**
 * Class SymfonyContainerAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SymfonyContainerAdapter implements PhalconDiInterface, SymfonyContainerInterface, ContainerInterface
{
    private $symfonyContainer;

    /**
     * SymfonyContainerAdapter constructor.
     *
     * @param SymfonyContainer $symfonyContainer
     */
    public function __construct(SymfonyContainer $symfonyContainer)
    {
        $this->symfonyContainer = $symfonyContainer;
    }

    /**
     * @inheritDoc
     */
    public function isFrozen()
    {
        return $this->symfonyContainer->isFrozen();
    }

    /**
     * @inheritDoc
     */
    public function compile()
    {
        return $this->symfonyContainer->compile();
    }

    /**
     * @inheritDoc
     */
    public function set($name, $definition, $shared = false)
    {
        $this->symfonyContainer->set($name, $definition);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setShared($name, $definition)
    {
        return $this->set($name, $definition);
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
        if ($this->hasParameter($name)) {
            return $this->getParameter($name);
        }

        $result = $this->symfonyContainer->get($name);

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
        return $this->symfonyContainer->has($name);
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

    /**
     * @inheritDoc
     */
    public function initialized($id)
    {
        return $this->symfonyContainer->initialized($id);
    }

    /**
     * @inheritDoc
     */
    public function getParameter($name)
    {
        return $this->symfonyContainer->getParameter($name);
    }

    /**
     * @inheritDoc
     */
    public function hasParameter($name)
    {
        return $this->symfonyContainer->hasParameter($name);
    }

    /**
     * @inheritDoc
     */
    public function setParameter($name, $value)
    {
        $this->symfonyContainer->setParameter($name, $value);

        return $this;
    }
}
