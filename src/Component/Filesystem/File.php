<?php
namespace Laventure\Component\Filesystem;



use Laventure\Component\Filesystem\Loader\FileLoader;
use Laventure\Component\Filesystem\Reader\DirectoryReader;
use Laventure\Component\Filesystem\Reader\FileReader;
use Laventure\Component\Filesystem\Uploader\FileUploader;
use Laventure\Component\Filesystem\Writer\FileWriter;


/**
 * @File
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem
*/
class File extends FileInfo
{

       /**
        * @var FileWriter
       */
       protected FileWriter $writer;




       /**
        * @var FileReader
       */
       protected FileReader $reader;





       /**
        * @var FileUploader
       */
       protected FileUploader $uploader;





       /**
        * @var FileLoader
       */
       protected FileLoader $loader;



       /**
        * @param string $path
       */
       public function __construct(string $path)
       {
            parent::__construct($path);
            $this->writer   = new FileWriter();
            $this->reader   = new FileReader();
            $this->uploader = new FileUploader();
            $this->loader   = new FileLoader();
       }






      /**
       * @return string
      */
      public function getName(): string
      {
          return $this->getFilename();
      }





      /**
       * @return string
      */
      public function path(): string
      {
           return $this->getPathname();
      }





     /**
      * @return bool
     */
     public function exists(): bool
     {
         return file_exists($this->path());
     }





     /**
      * @return false|mixed
     */
     public function load(): mixed
     {
         if (! $this->exists()) {
             return false;
         }

         return $this->loader->load($this->path());
     }






     /**
      * @return bool
     */
     public function make(): bool
     {
         $this->dir()->make();

         return touch($this->path());
     }






     /**
      * @return DirectoryReader
     */
     public function dir(): DirectoryReader
     {
         return new DirectoryReader($this->getDirname());
     }






    /**
     * @param string $destination
     *
     * @param $context
     *
     * @return bool
     */
     public function copyTo(string $destination, $context = null): bool
     {
         return $this->uploader->copy($this->path(), $destination, $context);
     }







     /**
      * @param string $destination
      *
      * @return bool
     */
     public function moveTo(string $destination): bool
     {
         return $this->uploader->upload($this->path(), $destination);
     }





     /**
      * @param string $content
      *
      * @param bool $append
      *
      * @return false|int
     */
     public function write(string $content, bool $append = false): false|int
     {
         if (! $this->exists()) { $this->make(); }

         return $this->writer->writeTo($this->path(), $content, $append);
     }





     /**
      * @param string $content
      *
      * @return bool|int
     */
     public function rewrite(string $content): bool|int
     {
          $this->remove();

          return $this->write($content);
     }






     /**
      * @return string
     */
     public function read(): string
     {
         if (! $this->exists()) {
             return '';
         }

         return $this->reader->read($this->path());
     }




     /**
      * @param array $patterns
      *
      * @return string
     */
     public function stub(array $patterns): string
     {
         $searched = array_keys($patterns);
         $replaced = array_values($patterns);

         return (string) str_replace($searched, $replaced, $this->read());
     }






     /**
      * @return bool
     */
     public function remove(): bool
     {
         if (! $this->exists()) {
             return false;
         }

         return unlink($this->path());
     }





     /**
      * @return array|false
     */
     public function asArray(): bool|array
     {
         return file($this->getRealPath(),  FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
     }
}