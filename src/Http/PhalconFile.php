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

namespace Vainyl\Phalcon\Http;

use Phalcon\Http\Request\FileInterface;
use Vainyl\Http\Decorator\AbstractFileDecorator;

/**
 * Class PhalconFile
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconFile extends AbstractFileDecorator implements FileInterface
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getClientFilename();
    }

    /**
     * @inheritDoc
     */
    public function getTempName()
    {
        return $this->getStream()->getMetadata('uri');
    }

    /**
     * @inheritDoc
     */
    public function getType()
    {
        return $this->getClientMediaType();
    }

    /**
     * @inheritDoc
     */
    public function getRealType()
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        if (false === is_resource($fileInfo)) {
            return '';
        }

        return finfo_file($fileInfo, $this->getStream()->getResource());
    }

    /**
     * Checks whether the file has been uploaded via Post.
     */
    public function isUploadedFile()
    {
        return is_uploaded_file($this->getTempName());
    }
}
