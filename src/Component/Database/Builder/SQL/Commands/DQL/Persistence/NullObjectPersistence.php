<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence;


/**
 * @inheritdoc
*/
class NullObjectPersistence implements ObjectPersistenceInterface
{

    /**
     * @var array
    */
    protected array $storage = [];



    /**
     * @inheritDoc
    */
    public function saveResult(array $objects): array
    {
          foreach ($objects as $object) {
               $this->saveOne($object);
          }

          return $objects;
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function saveOne(mixed $object): mixed
    {
         if (is_object($object)) {
             $this->storage[] = $object;
         }

         return $object;
    }
}