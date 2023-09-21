<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;

use ReflectionClass;



/**
 * @inheritdoc
*/
class NullClassMetadata implements ClassMetadataInterface
{


    /**
     * @inheritDoc
    */
    public function getClassname(): string
    {
         return '';
    }



    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        return '';
    }




    /**
     * @inheritDoc
    */
    public function getIdentifier(): string
    {
        return '';
    }





    /**
     * @inheritDoc
    */
    public function isIdentifier(string $field): bool
    {
         return false;
    }




    /**
     * @inheritDoc
    */
    public function getInfoClass(): ReflectionClass
    {
        return new ReflectionClass(get_class($this));
    }





    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
        return [];
    }





    /**
     * @inheritDoc
    */
    public function hasMethod(string $name): bool
    {
        return false;
    }
}