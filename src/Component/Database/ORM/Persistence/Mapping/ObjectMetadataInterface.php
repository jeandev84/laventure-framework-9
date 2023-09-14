<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;


use Laventure\Component\Database\ORM\Collection\Collection;
use Laventure\Component\Database\ORM\Persistence\PersistCollection;
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
interface ObjectMetadataInterface
{

     /**
      * @return ClassMetadataInterface
     */
     public function getClassMetadata(): ClassMetadataInterface;






     /**
      * @return ReflectionObject
     */
     public function getReflection(): ReflectionObject;





    /**
     * Get columns value
     *
     * @return array
    */
    public function getIdentifierValues(): array;







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
    public function isSingleAssociation(string $field): bool;







    /**
     * Determine if field is collection
     *
     * @param string $field
     *
     * @return bool
     */
    public function isCollectionAssociation(string $field): bool;







    /**
     * Determine if the given field name is class identifier
     *
     * @param string $field
     *
     * @return bool
    */
    public function isIdentifier(string $field): bool;







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
    public function identified(): bool;










    /**
     * @return Collection
    */
    public function getCollection(): Collection;








    /**
     * Returns object context
     *
     * @return object
    */
    public function getSubject(): object;
}