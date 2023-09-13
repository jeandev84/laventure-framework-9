<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence;


/**
 * @inheritdoc
*/
class ObjectPersistence implements ObjectPersistenceInterface
{


    /**
     * @var object[]
    */
    protected array $managed = [];





    /**
     * @inheritDoc
    */
    public function persistence(array $objects): mixed
    {
         foreach ($objects as  $object) {
             if (! is_object($object)) {
                  continue;
             }
             $this->managed[] = $object;
         }

         return $objects;
    }
}