<?php
namespace Laventure\Component\Database\Builder\SQL;


use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\Expr\Expr;
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
     * @return Expr
    */
    public function expr(): Expr
    {
         return new Expr();
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
        $builder = new InsertBuilder($this->connection, $table);
        $builder->insert($attributes);
        return $builder;
    }








    /**
     * @inheritDoc
    */
    public function update(string $table, array $attributes): UpdateBuilder
    {
        $builder = new UpdateBuilder($this->connection, $table);
        $builder->update($attributes);
        return $builder;
    }







    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilder
    {
        return new DeleteBuilder($this->connection, $table);
    }
}