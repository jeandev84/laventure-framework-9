<?php
namespace Laventure\Component\Database\Connection\Query;


/**
 * @inheritdoc
*/
class NullQueryResult implements QueryResultInterface
{

    /**
     * @inheritDoc
    */
    public function all(): array
    {
         return [];
    }




    /**
     * @inheritDoc
    */
    public function one(): mixed
    {
        return null;
    }




    /**
     * @inheritDoc
    */
    public function assoc(): array
    {
        return [];
    }





    /**
     * @inheritDoc
    */
    public function column(int $column = 0): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function columns(): array
    {
         return [];
    }





    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return 0;
    }
}