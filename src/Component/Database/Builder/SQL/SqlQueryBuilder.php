<?php
namespace Laventure\Component\Database\Builder\SQL;


use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Insert;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * @inheritdoc
*/
class SqlQueryBuilder implements SqlQueryBuilderInterface
{


    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(protected ConnectionInterface $connection)
    {
    }





    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilder
    {
         return new SelectBuilder($this->connection, $selects);
    }






    /**
     * @inheritDoc
    */
    public function insert(string $table, array $attributes): InsertBuilder
    {
        $command = new InsertBuilder($this->connection, $table);
        $command->insert($attributes);
        return $command;
    }






    /**
     * @inheritDoc
     */
    public function update(string $table, array $attributes): UpdateBuilder
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function delete(string $table): DeleteBuilder
    {
        // TODO: Implement delete() method.
    }
}