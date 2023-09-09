<?php
namespace Laventure\Component\Filesystem\Writer;

use Laventure\Component\Filesystem\Writer\Contract\FileWriterInterface;

/**
 * @inheritdoc
*/
class FileWriter implements FileWriterInterface
{

    /**
     * @inheritDoc
    */
    public function write(string $path, string $content): false|int
    {
        return $this->put($path, $content);
    }





    /**
     * @param string $path
     *
     * @param string $content
     *
     * @return false|int
    */
    public function append(string $path, string $content): false|int
    {
        return $this->put($path, $content.PHP_EOL, FILE_APPEND | LOCK_EX);
    }






    /**
     * @param string $path
     *
     * @param string $content
     *
     * @param bool $append
     *
     * @return false|int
    */
    public function writeTo(string $path, string $content, bool $append = false): bool|int
    {
         if (! $append) {
            return $this->write($path, $content);
         }

         return $this->append($path, $content);
    }








    /**
     * @param string $path
     *
     * @param string $content
     *
     * @param int $flags
     *
     * @param $context
     *
     * @return false|int
    */
    private function put(string $path, string $content, int $flags = 0, $context = null): bool|int
    {
        return file_put_contents($path, $content, $flags, $context);
    }
}