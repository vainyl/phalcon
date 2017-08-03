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
 * Class BadRedirectCodeException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BadRedirectCodeException extends AbstractResponseException
{
    private $code;

    /**
     * BadRedirectCodeException constructor.
     *
     * @param ResponseInterface $response
     * @param int               $code
     */
    public function __construct(ResponseInterface $response, int $code)
    {
        $this->code = $code;
        parent::__construct($response, sprintf('Unsupported code %d for redirection', $code));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['code' => $this->code], parent::toArray());
    }
}
