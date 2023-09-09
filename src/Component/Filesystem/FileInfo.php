<?php
namespace Laventure\Component\Filesystem;

/**
 * @FileInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem
*/
class FileInfo extends \SplFileInfo
{
     /**
      * @return string
     */
     public function getDirname(): string
     {
         return $this->getPath();
     }
}