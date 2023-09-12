<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;

/**
 * @inheritdoc
*/
class NullClassMetadataFactory implements ClassMetadataFactoryInterface
{

    /**
     * @inheritDoc
    */
    public function createClassMetadata(string $classname): ClassMetadata
    {
         throw new \RuntimeException("Could not create metadata for $classname");
    }
}