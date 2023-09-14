<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping\Factory;

use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\ObjectMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\ObjectMetadataInterface;


/**
 * @MetadataFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping\Factory
*/
class MetadataFactory
{

    /**
     * @param string $classname
     *
     * @return ClassMetadataInterface
    */
    public function createFromClass(string $classname): ClassMetadataInterface
    {
         return new ClassMetadata($classname);
    }






    /**
     * @param object $object
     *
     * @return ObjectMetadataInterface
    */
    public function createFromObject(object $object): ObjectMetadataInterface
    {
         return new ObjectMetadata($object);
    }
}