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
         return $this->criteria($wheres);
    }






    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
         return $this->statement()
                     ->setParameters($this->parameters)
                     ->execute();
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
       return $this->addSQL(sprintf('DELETE FROM %s', $this->getTable()))
                   ->addSQLConditions();
    }
}