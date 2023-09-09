<?php
namespace Laventure\Component\Filesystem\Loader;

use Laventure\Component\Filesystem\Loader\Contract\FileLoaderInterface;


/**
 * @inheritdoc
*/
class FileLoader implements FileLoaderInterface
{

    /**
     * @inheritDoc
    */
    public function load(string $path): mixed
    {
        return require_once $path;
    }
}