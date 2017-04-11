<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-phalcon
 */
declare(strict_types=1);

namespace Vainyl\Phalcon\Exception;

use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Phalcon\Database\Factory\PhalconDatabaseFactory;

/**
 * Class UnknownPhalconDriverException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnknownPhalconTypeException extends AbstractCoreException
{
    private $databaseFactory;

    private $driver;

    /**
     * UnknownPhalconDriverException constructor.
     *
     * @param PhalconDatabaseFactory $databaseFactory
     * @param string                 $driver
     */
    public function __construct(PhalconDatabaseFactory $databaseFactory, string $driver)
    {
        $this->databaseFactory = $databaseFactory;
        $this->driver = $driver;
        parent::__construct(sprintf('Cannot create phalcon database of unknown type %s', $driver));
    }

    /**
     * @return PhalconDatabaseFactory
     */
    public function getDatabaseFactory()
    {
        return $this->databaseFactory;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['driver' => $this->driver], parent::toArray());
    }
}
