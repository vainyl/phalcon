<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Phalcon\Http\Factory;

use Phalcon\FilterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Http\Factory\Decorator\AbstractRequestFactoryDecorator;
use Vainyl\Http\Factory\RequestFactoryInterface;
use Vainyl\Phalcon\Http\PhalconRequest;

/**
 * Class PhalconRequestFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconRequestFactory extends AbstractRequestFactoryDecorator
{
    private $filter;

    /**
     * PhalconRequestFactory constructor.
     *
     * @param RequestFactoryInterface $requestFactory
     * @param FilterInterface         $filter
     */
    public function __construct(RequestFactoryInterface $requestFactory, FilterInterface $filter)
    {
        $this->filter = $filter;
        parent::__construct($requestFactory);
    }

    /**
     * @inheritDoc
     */
    public function createRequest(string $method, UriInterface $uri): RequestInterface
    {
        return new PhalconRequest($this->filter, parent::createServerRequest($method, $uri));
    }

    /**
     * @inheritDoc
     */
    public function createServerRequest(string $method, UriInterface $uri): ServerRequestInterface
    {
        return new PhalconRequest($this->filter, parent::createServerRequest($method, $uri));
    }

    /**
     * @inheritDoc
     */
    public function create(array $requestData): ServerRequestInterface
    {
        return new PhalconRequest($this->filter, parent::create($requestData));
    }
}