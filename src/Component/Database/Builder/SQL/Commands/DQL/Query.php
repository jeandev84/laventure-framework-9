<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;

use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\QueryHydrateInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence\PersistenceResultInterface;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;


/**
 * @inheritdoc
*/
class Query implements QueryHydrateInterface
{


    public function __construct(
        protected QueryResultInterface $query,
        protected PersistenceResultInterface $persistence
    )
    {
    }





    /**
     * @inheritDoc
    */
    public function getResult(): mixed
    {
        return $this->persistence->saveResult($this->query->all());
    }






    /**
     * @inheritDoc
    */
    public function getOneOrNullResult(): mixed
    {
        return $this->persistence->saveOneResult($this->query->one());
    }






    /**
     * @inheritDoc
    */
    public function getArrayResult(): array
    {
         return $this->query->assoc();
    }





    /**
     * @inheritDoc
    */
    public function getArrayColumns(): array
    {
        return $this->query->columns();
    }







    /**
     * @inheritDoc
    */
    public function getColumn(int $index = 0): mixed
    {
        return $this->query->column($index);
    }




    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $this->query->count();
    }

}