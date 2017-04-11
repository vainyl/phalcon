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
declare(strict_types=1);

namespace Vainyl\Phalcon\Exception;

use Psr\Http\Message\ResponseInterface;
use Vainyl\Http\Exception\AbstractResponseException;

/**
 * Class UnsupportedResponseCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedResponseCallException extends AbstractResponseException
{
    private $method;

    /**
     * UnsupportedResponseCallException constructor.
     *
     * @param ResponseInterface $response
     * @param string            $method
     */
    public function __construct(ResponseInterface $response, string $method)
    {
        $this->method = $method;
        parent::__construct($response, sprintf('Call to method %s on response object is not supported', $method));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['method' => $this->method], parent::toArray());
    }
}
