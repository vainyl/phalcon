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

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;

/**
 * Class PhalconMvcQueryBuilder
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconMvcQueryBuilder extends Builder
{
    /**
     * Returns the query built
     */
    public function getQuery()
    {
        $query = new Query($this->getPhql(), $this->_dependencyInjector);

        if (is_array($this->_bindParams)) {
            $query->setBindParams($this->_bindParams);
        }

        if (is_array($this->_bindTypes)) {
            $query->setBindTypes($this->_bindTypes);
        }

        if (is_bool($this->_sharedLock)) {
            $query->setSharedLock($this->_sharedLock);
        }

        return $query;
    }
}
