<?php
namespace Laventure\Component\Filesystem\Uploader;

use Laventure\Component\Filesystem\Uploader\Contract\FileUploaderInterface;


/**
 * @inheritdoc
*/
class FileUploader implements FileUploaderInterface
{
    /**
     * @inheritDoc
    */
    public function upload(string $from, string $to): bool
    {
        return move_uploaded_file($from, $to);
    }




    /**
     * @param string $from
     *
     * @param string $destination
     *
     * @param null $context
     *
     * @return bool
    */
    public function copy(string $from, string $destination, $context = null): bool
    {
        return copy($from, $destination, $context);
    }
}