<?php
namespace Laventure\Component\Filesystem\Writer\Contract;


/**
 * @FileWriterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Writer\Contract
*/
interface FileWriterInterface
{
     /**
      * Write to the existent file
      *
      * @param string $path
      *
      * @param string $content
      *
      * @return mixed
     */
     public function write(string $path, string $content): mixed;
}