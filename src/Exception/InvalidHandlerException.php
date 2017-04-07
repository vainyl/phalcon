<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
declare(strict_types = 1);

namespace Vainyl\Phalcon\Exception;

use Vain\Core\Event\Dispatcher\EventDispatcherInterface;

/**
 * Class InvalidHandlerException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class InvalidHandlerException extends DispatcherException
{
    /**
     * InvalidHandlerException constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     * @param string                   $handler
     */
    public function __construct(EventDispatcherInterface $dispatcher, $handler)
    {
        parent::__construct($dispatcher, sprintf('Handler must be object, %s given', gettext($handler)));
    }
}
