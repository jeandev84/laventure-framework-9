<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping\Factory;

use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\NullClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\NullObjectMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\ObjectMetadataInterface;


/**
 * @inheritdoc
*/
class NullMetadataFactory implements MetadataFactoryInterface
{

    /**
     * @inheritDoc
    */
    public function createFromClass(string $classname): ClassMetadataInterface
    {
         return new NullClassMetadata();
    }




    /**
     * @inheritDoc
    */
    public function createFromObject(object $object): ObjectMetadataInterface
    {
        return new NullObjectMetadata();
    }
}