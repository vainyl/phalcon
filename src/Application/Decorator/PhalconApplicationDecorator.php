<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-operation
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-operation
 */

namespace Vainyl\Phalcon\Application\Decorator;

use Phalcon\Mvc\Application as PhalconMvcApplication;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Http\Application\Decorator\AbstractHttpApplicationDecorator;
use Vainyl\Http\Application\HttpApplicationInterface;

/**
 * Class PhalconApplicationDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApplicationDecorator extends AbstractHttpApplicationDecorator
{
    private $application;

    private $response;

    /**
     * PhalconApplication constructor.
     *
     * @param HttpApplicationInterface $httpApplication
     * @param PhalconMvcApplication    $application
     * @param ResponseInterface        $response
     */
    public function __construct(
        HttpApplicationInterface $httpApplication,
        PhalconMvcApplication $application,
        ResponseInterface $response
    ) {
        $this->application = $application;
        $this->response = $response;
        parent::__construct($httpApplication);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'app';
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->application->handle($request->getUri()->getPath());

        return $this->response;
    }
}
