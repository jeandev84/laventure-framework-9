<?php
namespace Laventure\Component\Database\Connection\Query;

class NullQuery implements QueryInterface
{

    /**
     * @inheritDoc
    */
    public function prepare(string $sql): static
    {
         return $this;
    }



    /**
     * @inheritDoc
    */
    public function bindParam($name, $value, int $type): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function bindValue($name, $value, int $type): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
         return false;
    }





    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function map(string $classname): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function fetch(): QueryResultInterface
    {
        return new NullQueryResult();
    }





    /**
     * @inheritDoc
    */
    public function lastId(): int
    {
         return 0;
    }






    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
         return '';
    }




    /**
     * @inheritDoc
    */
    public function getLogger(): QueryLogger
    {
        return new QueryLogger();
    }
}