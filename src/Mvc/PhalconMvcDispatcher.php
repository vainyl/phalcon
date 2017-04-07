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

use Phalcon\Mvc\Dispatcher;
use Phalcon\Text;

/**
 * Class PhalconMvcDispatcher
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconMvcDispatcher extends Dispatcher
{
    private $separator;

    /**
     * MvcDispatcher constructor.
     *
     * @param $separator
     */
    public function __construct($separator)
    {
        $this->separator = $separator;
    }

    /**
     * @return string
     */
    public function getHandlerClass()
    {
        $this->_resolveEmptyProperties();

        if (false === strpos("\\", $this->_handlerName)) {
            $camelizedClass = Text::camelize($this->_handlerName, '_-');
        } else {
            $camelizedClass = $this->_handlerName;
        }

        if (null === $this->_namespaceName) {
            return sprintf('%s%s%s', $camelizedClass, $this->separator, $this->_handlerSuffix);
        }

        $namespace = $this->_namespaceName;
        if ($this->separator !== substr($namespace, -1)) {
            $namespace .= $this->separator;
        }

        return $namespace . $camelizedClass . $this->_handlerSuffix;
    }
}
