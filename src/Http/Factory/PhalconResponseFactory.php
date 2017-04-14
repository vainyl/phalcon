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

use Psr\Http\Message\ResponseInterface;
use Vainyl\Http\Decorator\AbstractResponseFactoryDecorator;
use Vainyl\Phalcon\Http\PhalconResponse;

/**
 * Class PhalconResponseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconResponseFactory extends AbstractResponseFactoryDecorator
{
    /**
     * @inheritDoc
     */
    public function createResponse(int $statusCode = 200): ResponseInterface
    {
        return new PhalconResponse(parent::createResponse($statusCode));
    }
}