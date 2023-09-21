<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;

use Laventure\Component\Database\ORM\Collection\Collection;
use Laventure\Component\Database\ORM\Convertor\CamelConvertor;
use Laventure\Component\Database\ORM\Persistence\Mapping\Exception\MetadataException;
use Laventure\Component\Database\ORM\Persistence\PersistenceCollection;
use ReflectionObject;



/**
 * @inheritdoc
*/
class ObjectMetadata extends ClassMetadata implements ObjectMetadataInterface
{


     use CamelConvertor;




     /**
      * @var ReflectionObject
     */
     protected ReflectionObject $reflection;





     /**
      * @var ClassMetadata
     */
     protected ClassMetadata $metadata;




     /**
      * @var object|null
     */
     protected ?object $object;




     /**
      * @var array
     */
     protected array $identifiers = [];



     /**
      * @var array
     */
     protected array $attributes = [];




     /**
      * @var object[]
     */
     protected array $associations = [];





     /**
      * @var PersistenceCollection[]
     */
     protected array $hasMany = [];






     /**
      * @var object[]
     */
     protected array $belongsTo = [];





     /**
      * @var array
     */
     protected array $properties = [];





     /**
      * @param object $object
     */
     public function __construct(object $object)
     {
         try {
             parent::__construct(get_class($object));
             $this->reflection = $this->map($object);
             $this->object     = $object;
         } catch (\Exception $e) {
             throw new MetadataException($e->getMessage(), $e->getCode());
         }
     }







    /**
     * @inheritDoc
    */
    public function getInfoObject(): ReflectionObject
    {
        return $this->reflection;
    }



     

    /**
     * @inheritDoc
    */
    public function getFieldNames(): array
    {
        return array_keys($this->properties);
    }


    



    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getField(string $name): mixed
    {
        return $this->properties[$name] ?? null;
    }







    /**
     * @inheritDoc
    */
    public function hasField(string $field): bool
    {
         return isset($this->properties[$field]);
    }







    /**
     * @inheritDoc
    */
    public function hasAssociation(string $field): bool
    {
         return isset($this->associations[$field]);
    }






    /**
     * @inheritDoc
    */
    public function belongsTo(string $field): bool
    {
        return isset($this->belongsTo[$field]);
    }







    /**
     * @inheritDoc
    */
    public function hasMany(string $field): bool
    {
        return isset($this->hasMany[$field]);
    }






    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }







    /**
     * @return mixed
    */
    public function getId(): mixed
    {
        return $this->identifiers[$this->getIdentifier()] ?? null;
    }






    /**
     * @inheritDoc
    */
    public function hasIdentifier(): bool
    {
         return ! empty($this->identifiers[$this->identifier]);
    }


    



    /**
     * @inheritDoc
    */
    public function getCollectionAssociations(): array
    {
        return $this->hasMany;
    }





    /**
     * @return object[]
    */
    public function getSingleAssociations(): array
    {
         return $this->belongsTo;
    }





    /**
     * @inheritDoc
    */
    public function getSubject(): object
    {
        return $this->object;
    }






    /**
     * @inheritdoc 
    */
    public function getIdentifiers(): array
    {
        return $this->identifiers;
    }





    /**
     * @inheritdoc
    */
    public function getProperties(): array
    {
        return $this->properties;
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

            $name    = $property->getName();
            $field   = $this->camelCaseToUnderscore($name);
            $value   = $property->getValue($object);

            if ($this->isIdentifier($name)) {
                $this->identifiers[$field] = $value;
            } elseif (is_object($value)) {
                 if ($value instanceof \DateTimeInterface) {
                      $this->attributes[$field] = $value->format('Y-m-d H:i:s');
                 } elseif ($value instanceof Collection) {
                      $collection           = new PersistenceCollection($value);
                      $this->hasMany[$name] = $collection;
                      $this->associations[$name] = $collection;
                      $this->identifiers[$field.'_id'] = $collection;
                 } else {
                     $this->belongsTo[$name]    = $value;
                     $this->associations[$name] = $value;
                     $this->identifiers[$field.'_id'] = $value;
                 }
            } else {
                 $this->attributes[$field] = $value;
            }

            $this->properties[$name] = $value;
        }

        return $reflection;
    }
}