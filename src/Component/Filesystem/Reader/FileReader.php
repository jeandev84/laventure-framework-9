<?php
namespace Laventure\Component\Filesystem\Reader;


use Laventure\Component\Filesystem\Reader\Contract\FileReaderInterface;

/**
 * @inheritdoc
*/
class FileReader implements FileReaderInterface
{

    /**
     * @inheritDoc
    */
    public function read(string $path): string
    {
         return file_get_contents($path);
    }
}