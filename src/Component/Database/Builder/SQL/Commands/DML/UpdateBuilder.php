<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditions;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\UpdateBuilderInterface;


/**
 * @inheritdoc
*/
class UpdateBuilder extends BuilderConditions implements UpdateBuilderInterface
{



    /**
     * @inheritDoc
     */
    public function update(array $attributes): static
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
    public function execute(): bool
    {

    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {

    }
}