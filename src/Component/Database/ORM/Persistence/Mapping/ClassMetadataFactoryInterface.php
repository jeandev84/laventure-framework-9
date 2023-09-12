<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;


/**
 * @ClassMetadataFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping
*/
interface ClassMetadataFactoryInterface
{
      /**
       * @param string $classname
       *
       * @return ClassMetadata
      */
      public function createClassMetadata(string $classname): ClassMetadata;
}