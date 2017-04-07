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

namespace Vainyl\Phalcon\Database\Factory;

use Vain\Core\Connection\ConnectionInterface;
use Vain\Core\Database\Factory\AbstractDatabaseFactory;
use Vain\Core\Database\Generator\Factory\DatabaseGeneratorFactoryInterface;
use Vainyl\Phalcon\Database\PhalconMysqlAdapter;
use Vainyl\Phalcon\Database\PhalconPostgresqlAdapter;
use Vainyl\Phalcon\Exception\UnknownPhalconTypeException;

/**
 * Class PhalconDatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconDatabaseFactory extends AbstractDatabaseFactory
{
    private $generatorFactory;

    /**
     * PhalconDatabaseFactory constructor.
     *
     * @param string                    $name
     * @param DatabaseGeneratorFactoryInterface $generatorFactory
     */
    public function __construct($name, DatabaseGeneratorFactoryInterface $generatorFactory)
    {
        $this->generatorFactory = $generatorFactory;
        parent::__construct($name);
    }

    /**
     * @inheritDoc
     */
    public function createDatabase(array $configData, ConnectionInterface $connection)
    {
        $type = $configData['type'];
        switch ($type) {
            case 'pgsql':
                return new PhalconPostgresqlAdapter($this->generatorFactory, $connection);
                break;
            case 'mysql':
                return new PhalconMysqlAdapter($this->generatorFactory, $connection);
                break;
            default:
                throw new UnknownPhalconTypeException($this, $type);
        }
    }
}
