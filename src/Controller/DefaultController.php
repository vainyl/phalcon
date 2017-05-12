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

/**
 * Class DefaultController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DefaultController extends AbstractController
{
    public function indexAction()
    {
        $contentType = $this->request->hasHeader('Content-Type') ? $this->request->getContentType() : 'null';

        $this->response
            ->withStatus(200)
            ->getBody()
            ->write($this->getEncoder($contentType)->encode('It works!'));
    }
}