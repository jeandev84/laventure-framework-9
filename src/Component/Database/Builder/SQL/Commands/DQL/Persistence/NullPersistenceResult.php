<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence;


/**
 * @inheritdoc
*/
class NullPersistenceResult implements PersistenceResultInterface
{

    /**
     * @inheritDoc
     */
    public function saveResult(array $objects): array
    {
         return [];
    }

    
    
    
    
    /**
     * @inheritDoc
    */
    public function saveOneResult(object $object): object
    {
         return $object;
    }
}