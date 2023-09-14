<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;

use Laventure\Component\Database\ORM\Collection\Collection;
use Laventure\Component\Database\ORM\Convertor\CamelConvertor;
use Laventure\Component\Database\ORM\Persistence\Mapping\Exception\MetadataException;
use Laventure\Component\Database\ORM\Persistence\PersistCollection;
use Laventure\Component\Database\ORM\Persistence\PersistenceCollection;
use ReflectionObject;



/**
 * @inheritdoc
*/
class ObjectMetadata implements ObjectMetadataInterface
{


     use CamelConvertor;




     /**
      * @var ReflectionObject
     */
     protected ReflectionObject $reflection;



     /**
      * @var ClassMetadataInterface
     */
     protected ClassMetadataInterface $metadata;




     /**
      * @var object|null
     */
     protected ?object $object;




     /**
      * @var array
     */
     protected array $attributes = [];





     /**
      * @var PersistenceCollection[]
     */
     protected array $collections = [];






     /**
      * @var object[]
     */
     protected array $identifiers = [];





     /**
      * @param object $object
     */
     public function __construct(object $object)
     {
         try {
             $this->reflection = $this->map($object);
             $this->metadata   = new ClassMetadata($this->reflection->getName());
             $this->object     = $object;
         } catch (\Exception $e) {
             throw new MetadataException($e->getMessage(), $e->getCode());
         }
     }










    /**
     * @inheritDoc
    */
    public function getFieldNames(): array
    {

    }







    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getField(string $name): mixed
    {
        return $this->reflection->getAttributes($name);
    }






    /**
     * @inheritDoc
     */
    public function hasField(string $field): bool
    {

    }






    /**
     * @inheritDoc
    */
    public function hasAssociation(string $field): bool
    {

    }






    /**
     * @inheritDoc
    */
    public function isSingleAssociation(string $field): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function isCollectionAssociation(string $field): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function getClassMetadata(): ClassMetadataInterface
    {
         return $this->metadata;
    }





    /**
     * @inheritDoc
    */
    public function getReflection(): ReflectionObject
    {
        return $this->reflection;
    }






    /**
     * @inheritDoc
    */
    public function getIdentifierValues(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function isIdentifier(string $field): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }




    /**
     * @inheritDoc
    */
    public function identified(): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function getCollection(): Collection
    {

    }






    /**
     * @inheritDoc
    */
    public function getSubject(): object
    {
        return $this->object;
    }





    /**
     * @param object $object
     *
     * @return ReflectionObject
    */
    private function map(object $object): ReflectionObject
    {
        $reflection = new ReflectionObject($object);

        foreach ($reflection->getProperties() as $property) {
            $name  = $property->getName();
            $this->attributes[$name] = $property->getValue($object);
        }

        return $reflection;
    }
}