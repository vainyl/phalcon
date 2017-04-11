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

use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Exception\AbstractDatabaseException;

/**
 * Class PhalconQueryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconQueryException extends AbstractDatabaseException
{
    private $query;

    private $params;

    /**
     * PhalconQueryException constructor.
     *
     * @param DatabaseInterface $database
     * @param string            $query
     * @param array             $params
     */
    public function __construct(DatabaseInterface $database, string $query, array $params = [])
    {
        parent::__construct($database, sprintf('Cannot execute query %s', $query));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['query' => $this->query, 'params' => $this->params], parent::toArray());
    }
}
