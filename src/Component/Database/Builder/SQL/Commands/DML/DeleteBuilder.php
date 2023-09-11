<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditions;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\DeleteBuilderInterface;



/**
 * @inheritdoc
*/
class DeleteBuilder extends BuilderConditions implements DeleteBuilderInterface
{


    /**
     * @inheritDoc
    */
    public function delete(array $wheres = []): static
    {

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