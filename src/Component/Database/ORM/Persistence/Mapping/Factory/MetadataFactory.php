<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping\Factory;

use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\ObjectMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\ObjectMetadataInterface;


/**
 * @inheritdoc
*/
class MetadataFactory implements MetadataFactoryInterface
{

    /**
     * @inheritdoc
    */
    public function createFromClass(string $classname): ClassMetadataInterface
    {
         return new ClassMetadata($classname);
    }






    /**
     * @inheritdoc
    */
    public function createFromObject(object $object): ObjectMetadataInterface
    {
         return new ObjectMetadata($object);
    }
}