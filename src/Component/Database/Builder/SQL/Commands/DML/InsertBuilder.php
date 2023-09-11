<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;


use Laventure\Component\Database\Builder\SQL\Commands\Builder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\InsertBuilderInterface;


/**
 * @inheritdoc
*/
class InsertBuilder extends Builder implements InsertBuilderInterface
{

    /**
     * @var array
    */
    protected array $attributes = [];



    /**
     * @inheritDoc
    */
    public function insert(array $attributes): static
    {
         return $this;
    }



    /**
     * @inheritDoc
    */
    public function set(string $name, $value): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function execute(): int
    {

    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        // TODO: Implement getSQL() method.
    }
}