<?php
namespace Laventure\Component\Database\ORM\Persistence\Repository;

class NullEntityRepository implements EntityRepositoryInterface
{

    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        return null;
    }




    /**
     * @inheritDoc
    */
    public function findOneBy(array $criteria, array $oderBy = []): mixed
    {
         return [];
    }




    /**
     * @inheritDoc
    */
    public function findAll(): array
    {
        return [];
    }





    /**
     * @inheritDoc
    */
    public function findBy(array $criteria, array $orderBy = [], int $limit = null, int $offset = null): mixed
    {
         return [];
    }




    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
         return '';
    }
}