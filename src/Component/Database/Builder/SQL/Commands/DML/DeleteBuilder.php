<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditions;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\HasTable;


/**
 * @inheritdoc
*/
class DeleteBuilder extends BuilderConditions implements DeleteBuilderInterface
{


    use HasTable;


    /**
     * @inheritDoc
    */
    public function delete(array $wheres = []): static
    {
         return $this->criteria($wheres);
    }






    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
         return $this->getStatement()
                     ->setParameters($this->parameters)
                     ->execute();
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
       return $this->addSQLPart(sprintf('DELETE FROM %s', $this->getTable()))
                   ->addConditions();
    }
}