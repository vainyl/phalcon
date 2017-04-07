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

namespace Vainyl\Phalcon\Application;

use Phalcon\Mvc\Application;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Core\Application\AbstractApplication;
use Vainyl\Http\Application\HttpApplicationInterface;

/**
 * Class PhalconApplication
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApplication extends AbstractApplication implements HttpApplicationInterface
{
    private $application;

    private $response;

    /**
     * PhalconApplication constructor.
     *
     * @param Application       $application
     * @param ResponseInterface $response
     */
    public function __construct(Application $application, ResponseInterface $response)
    {
        $this->application = $application;
        $this->response = $response;
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
