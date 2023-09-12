<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence;


/**
 * @inheritdoc
*/
class ObjectPersistence implements ObjectPersistenceInterface
{

    /**
     * @var array
    */
    protected array $items = [];



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
             $this->items[] = $object;
         }

         return $object;
    }

    /**
     * @inheritDoc
    */
    public function getSaved(): array
    {
         return $this->items;
    }
}