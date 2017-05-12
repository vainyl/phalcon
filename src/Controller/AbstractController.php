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

use Phalcon\Mvc\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Core\Encoder\EncoderInterface;
use Vainyl\Core\Encoder\Storage\EncoderStorageInterface;
use Vainyl\Phalcon\Http\PhalconRequest;
use Vainyl\Phalcon\Http\PhalconResponse;

/**
 * Class AbstractController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @property PhalconRequest  request
 * @property PhalconResponse response
 * @property \ArrayAccess    cookies
 */
abstract class AbstractController extends Controller implements ControllerInterface
{
    /**
     * @var EncoderStorageInterface
     */
    private $encoderStorage;

    /**
     * @param EncoderStorageInterface $encoderStorage
     */
    public function initialize(EncoderStorageInterface $encoderStorage)
    {
        $this->encoderStorage = $encoderStorage;
    }

    /**
     * @param string $alias
     *
     * @return EncoderInterface
     */
    public function getEncoder(string $alias): EncoderInterface
    {
        return $this->encoderStorage->getEncoder($alias);
    }

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