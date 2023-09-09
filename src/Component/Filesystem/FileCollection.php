<?php
namespace Laventure\Component\Filesystem;


/**
 * @FileCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem
*/
class FileCollection
{

      /**
       * @var File[]
      */
      protected array $files = [];



      /**
       * @var array
      */
      protected array $removed = [];





      /**
       * @param string[] $files
      */
      public function __construct(array $files)
      {
           $this->collect($files);
      }





      /**
       * @param File $file
       *
       * @return $this
      */
      public function add(File $file): static
      {
          $this->files[] = $file;

          return $this;
      }




      /**
       * @return int
      */
      public function count(): int
      {
           return count($this->files);
      }






      /**
       * @param string[] $files
       *
       * @return $this
      */
      public function collect(array $files): static
      {
          foreach ($files as $path) {
              $this->add(new File($path));
          }

          return $this;
      }






      /**
       * @return File[]
      */
      public function getFiles(): array
      {
          return $this->files;
      }





      /**
       * Returns count of removed files
       *
       * @return int
      */
      public function remove(): int
      {
           foreach ($this->files as $file) {
               if ($file->remove()) {
                   $this->removed[] = $file->getPath();
               }
           }

           return count($this->removed);
      }






      /**
       * @return array
      */
      public function getRemovedFiles(): array
      {
           return $this->removed;
      }
}