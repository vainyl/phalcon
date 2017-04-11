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

namespace Vainyl\Phalcon\Controller;

use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AbstractController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @property ServerRequestInterface request
 * @property ResponseInterface response
 * @property \ArrayAccess cookies
 */
class AbstractController extends Controller implements ControllerInterface
{
    /**
     * @inheritDoc
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    /**
     * @inheritDoc
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @inheritDoc
     */
    public function getCookies(): \ArrayAccess
    {
        return $this->cookies;
    }
}