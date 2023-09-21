<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;


use Laventure\Component\Database\ORM\Collection\Collection;
use Laventure\Component\Database\ORM\Persistence\PersistenceCollection;
use ReflectionObject;

/**
 * @ObjectMetadataInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping
*/
interface ObjectMetadataInterface extends ClassMetadataInterface
{


     /**
      * @return ReflectionObject
     */
     public function getInfoObject(): ReflectionObject;







    /**
     * @return array
    */
    public function getFieldNames(): array;








    /**
     * Determine if the given field name in class metadata
     *
     * @param string $field
     *
     * @return bool
    */
    public function hasField(string $field): bool;







    /**
     * Determine if the given field has association fields
     *
     * @param string $field
     *
     * @return bool
    */
    public function hasAssociation(string $field): bool;








    /**
     * Determine if field has value object or other value
     *
     * @param string $field
     *
     * @return bool
    */
    public function belongsTo(string $field): bool;







    /**
     * Determine if field is collection
     *
     * @param string $field
     *
     * @return bool
     */
    public function hasMany(string $field): bool;








    /**
     * Returns class attributes
     *
     * @return array
    */
    public function getAttributes(): array;









    /**
     * Determine if object is new
     *
     * @return bool
    */
    public function hasIdentifier(): bool;


    
    
    
    
    
    /**
     * Returns identifiers
     * 
     * @return array
    */
    public function getIdentifiers(): array;
    
    




    /**
     * @return PersistenceCollection[]
    */
    public function getCollectionAssociations(): array;






    /**
     * @return object[]
    */
    public function getSingleAssociations(): array;






    /**
     * Returns object context
     *
     * @return object
    */
    public function getSubject(): object;






    /**
     * Returns object properties
     *
     * @return array
    */
    public function getProperties(): array;
}