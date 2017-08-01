<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Phalcon-Bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Phalcon\Container\Factory;

use Psr\Container\ContainerInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Core\Application\EnvironmentInterface;
use Vainyl\Di\Factory\ContainerFactoryInterface;
use Vainyl\Phalcon\Container\PhalconContainerAdapter;

/**
 * Class PhalconContainerFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconContainerFactory extends AbstractIdentifiable implements ContainerFactoryInterface
{
    private $containerFactory;

    /**
     * PhalconContainerFactory constructor.
     *
     * @param ContainerFactoryInterface $containerFactory
     */
    public function __construct(ContainerFactoryInterface $containerFactory)
    {
        $this->containerFactory = $containerFactory;
    }

    /**
     * @inheritDoc
     */
    public function createContainer(EnvironmentInterface $environment): ContainerInterface
    {
        $container = new PhalconContainerAdapter($this->containerFactory->createContainer($environment));
        $container->set('app.di', $container);

        return $container;
    }
}