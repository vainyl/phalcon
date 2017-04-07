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

use Vain\Core\Exception\AbstractCoreException;
use Vain\Core\Http\Request\Factory\RequestFactoryInterface;

/**
 * Class HttpFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpFactoryException extends AbstractCoreException
{
    private $httpFactory;

    /**
     * HttpFactoryException constructor.
     *
     * @param RequestFactoryInterface $factory
     * @param string                  $message
     * @param int                     $code
     * @param \Exception              $previous
     */
    public function __construct(
        RequestFactoryInterface $factory,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->httpFactory = $factory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return RequestFactoryInterface
     */
    public function getHttpFactory()
    {
        return $this->httpFactory;
    }
}
