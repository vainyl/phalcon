<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Phalcon-Bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Phalcon\Exception;

use Vainyl\Event\EventDispatcherInterface;
use Vainyl\Event\Exception\AbstractDispatcherException;

/**
 * Class UnsupportedDispatcherCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedDispatcherCallException extends AbstractDispatcherException
{
    private $method;

    /**
     * UnsupportedDispatcherCallException constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param string                   $method
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, string $method)
    {
        $this->method = $method;
        parent::__construct(
            $eventDispatcher,
            sprintf('Call to method %s on event manager object is not supported', $method)
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['method' => $this->method], parent::toArray());
    }
}