<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;

use ReflectionObject;

class NullObjectMetadata extends NullClassMetadata implements ObjectMetadataInterface
{

    /**
     * @inheritDoc
    */
    public function getInfoObject(): ReflectionObject
    {
        return new ReflectionObject($this);
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function getFieldNames(): array
    {
         return [];
    }

    
    
    
    /**
     * @inheritDoc
    */
    public function hasField(string $field): bool
    {
        return false;
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function hasAssociation(string $field): bool
    {
        return false;
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function belongsTo(string $field): bool
    {
        return false;
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function hasMany(string $field): bool
    {
         return false;
    }

    
    
    
    
    
    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return [];
    }

    
    
    
    /**
     * @inheritDoc
    */
    public function hasIdentifier(): bool
    {
        return false;
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function getCollectionAssociations(): array
    {
        return [];
    }

    
    
    
    /**
     * @inheritDoc
    */
    public function getSingleAssociations(): array
    {
        return [];
    }

    
    
    
    /**
     * @inheritDoc
    */
    public function getSubject(): object
    {
         return $this;
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function getIdentifiers(): array
    {
         return [];
    }
}