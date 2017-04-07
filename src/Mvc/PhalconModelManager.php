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

namespace Vainyl\Phalcon\Mvc;

use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\BuilderInterface;

/**
 * Class PhalconModelManager
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconModelManager extends Manager
{
    /**
     * @param null $params
     *
     * @return BuilderInterface
     */
    public function createBuilder($params = null)
    {
        return new PhalconMvcQueryBuilder($params, $this->_dependencyInjector);
    }

    /**
     * @param string $phql
     * @param null   $placeholders
     * @param null   $types
     *
     * @return mixed
     */
    public function executeQuery($phql, $placeholders = null, $types = null)
    {
        $di = $this->getDI();

        $query = new Query($phql, $di);

        $this->_lastQuery = $query;

        return $query->execute($placeholders, $types);
    }
}
