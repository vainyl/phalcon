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

use Phalcon\Db\ResultInterface;
use Vainyl\Database\CursorInterface;

/**
 * Class PhalconCursor
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCursor implements CursorInterface
{
    private $phalconDbResult;

    /**
     * PhalconCursor constructor.
     *
     * @param ResultInterface $phalconDbResult
     */
    public function __construct(ResultInterface $phalconDbResult)
    {
        $this->phalconDbResult = $phalconDbResult;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->phalconDbResult->dataSeek(0);
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return ($this->phalconDbResult->getInternalResult()->errorCode() === '00000');
    }

    /**
     * @inheritDoc
     */
    public function current(): array
    {
        return $this->phalconDbResult->fetch();
    }

    /**
     * @inheritDoc
     */
    public function next(): bool
    {
        return $this->phalconDbResult->getInternalResult()->nextRowset();
    }

    /**
     * @inheritDoc
     */
    public function close(): CursorInterface
    {
        $this->phalconDbResult->getInternalResult()->closeCursor();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function mode(int $mode): CursorInterface
    {
        $this->phalconDbResult->setFetchMode($mode);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSingle(): array
    {
        return $this->phalconDbResult->fetch();
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->phalconDbResult->fetchAll();
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->phalconDbResult->numRows();
    }
}
