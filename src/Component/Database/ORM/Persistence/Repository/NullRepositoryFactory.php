<?php
namespace Laventure\Component\Database\ORM\Persistence\Repository;

/**
 * @inheritdoc
*/
class NullRepositoryFactory implements EntityRepositoryFactory
{

    /**
     * @inheritDoc
    */
    public function createRepository(string $classname): EntityRepositoryInterface
    {
         return new NullEntityRepository();
    }
}