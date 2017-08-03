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

namespace Vainyl\Phalcon\Database;

use Phalcon\Db\Adapter\Pdo\Postgresql as PhalconPostgresqlDatabase;
use Vainyl\Connection\ConnectionInterface;
use Vainyl\Database\CursorInterface;
use Vainyl\Database\MvccDatabaseInterface;
use Vainyl\Phalcon\Exception\PhalconQueryException;

/**
 * Class PhalconPostgresqlAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconPostgresqlAdapter extends PhalconPostgresqlDatabase implements MvccDatabaseInterface
{
    private $name;

    private $connection;

    /**
     * PhalconPostgresqlAdapter constructor.
     *
     * @param string              $name
     * @param ConnectionInterface $connection
     */
    public function __construct(string $name, ConnectionInterface $connection)
    {
        $this->name = $name;
        $this->connection = $connection;
        parent::__construct([]);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return spl_object_hash($this);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function connect(array $descriptor = null)
    {
        if (null === $this->_pdo) {
            $this->_pdo = $this->connection->establish();
        }

        return $this->_pdo;
    }

    /**
     * @inheritDoc
     */
    public function startTransaction(): bool
    {
        return $this->begin();
    }

    /**
     * @inheritDoc
     */
    public function commitTransaction(): bool
    {
        return $this->commit();
    }

    /**
     * @inheritDoc
     */
    public function rollbackTransaction(): bool
    {
        return $this->rollback();
    }

    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams, array $bindTypes = []): CursorInterface
    {
        if (false === ($result = $this->query($query, $bindParams, $bindTypes))) {
            throw new PhalconQueryException($this, $query, $bindParams);
        }

        return new PhalconCursor($result);
    }
}
