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

namespace Vainyl\Phalcon\Database\Factory;

use Phalcon\Db\Adapter\Pdo;
use Vainyl\Phalcon\Database\PhalconMysqlAdapter;
use Vainyl\Phalcon\Database\PhalconPostgresqlAdapter;
use Vainyl\Phalcon\Exception\UnknownPhalconTypeException;

/**
 * Class PhalconDatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconDatabaseFactory
{
    private $connectionStorage;

    /**
     * PdoDatabaseFactory constructor.
     *
     * @param \ArrayAccess $connectionStorage
     */
    public function __construct(\ArrayAccess $connectionStorage)
    {
        $this->connectionStorage = $connectionStorage;
    }

    /**
     * @param string $name
     * @param array  $configData
     *
     * @return Pdo
     */
    public function createDatabase(string $name, array $configData): Pdo
    {
        $type = $configData['type'];
        switch ($type) {
            case 'pgsql':
                return new PhalconPostgresqlAdapter($this->connectionStorage->offsetGet($configData['connection']));
                break;
            case 'mysql':
                return new PhalconMysqlAdapter($this->connectionStorage->offsetGet($configData['connection']));
                break;
            default:
                throw new UnknownPhalconTypeException($this, $type);
        }
    }
}
