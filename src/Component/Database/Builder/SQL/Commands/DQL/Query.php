<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;

use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\QueryHydrateInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence\ObjectPersistenceInterface;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;


/**
 * @inheritdoc
*/
class Query implements QueryHydrateInterface
{


    /**
     * @param QueryResultInterface $result
     *
     * @param ObjectPersistenceInterface $persistence
   */
    public function __construct(protected QueryResultInterface $result, protected ObjectPersistenceInterface $persistence)
    {
    }





    /**
     * @inheritDoc
    */
    public function getResult(): mixed
    {
        $objects =  $this->result->all();

        $this->persistence->persistence($objects);

        return $objects;
    }






    /**
     * @inheritDoc
    */
    public function getOneOrNullResult(): mixed
    {
         $object = $this->result->one();

         $this->persistence->persistence([$object]);

         return $object;
    }






    /**
     * @inheritDoc
    */
    public function getArrayResult(): array
    {
         return $this->result->assoc();
    }





    /**
     * @inheritDoc
    */
    public function getArrayColumns(): array
    {
        return $this->result->columns();
    }







    /**
     * @inheritDoc
    */
    public function getColumn(int $index = 0): mixed
    {
        return $this->result->column($index);
    }







    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $this->result->count();
    }

}