<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping\Factory;

use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadataInterface;


/**
 * @ClassMetadataFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping\Factory
*/
interface ClassMetadataFactoryInterface
{
      /**
       * @param string $classname
       *
       * @return ClassMetadataInterface
      */
      public function createClassMetadata(string $classname): ClassMetadataInterface;
}