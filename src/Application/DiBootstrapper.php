<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Phalcon\Application;

use Phalcon\Di;
use Psr\Container\ContainerInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Core\Application\ApplicationInterface;
use Vainyl\Core\Application\BootstrapperInterface;

/**
 * Class DiBootstrapper
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DiBootstrapper extends AbstractIdentifiable implements BootstrapperInterface
{
    private $container;

    /**
     * DiBootstrapper constructor.
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
    public function getName(): string
    {
        return 'di';
    }

    /**
     * @inheritDoc
     */
    public function process(ApplicationInterface $application): BootstrapperInterface
    {
        Di::setDefault($this->container);

        return $this;
    }
}