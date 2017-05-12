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

use Psr\Http\Message\UploadedFileInterface;
use Vainyl\Http\Factory\Decorator\AbstractFileFactoryDecorator;
use Vainyl\Phalcon\Http\PhalconFile;

/**
 * Class PhalconFileFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconFileFactory extends AbstractFileFactoryDecorator
{
    /**
     * @inheritDoc
     */
    public function createFile(
        string $source,
        int $size,
        int $error,
        string $fileName,
        string $mediaType
    ): UploadedFileInterface {
        return new PhalconFile(parent::createFile($source, $size, $error, $fileName, $mediaType));
    }
}