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
    public function select(string $selects = '*'): SelectBuilder
    {
         $builder = new SelectBuilder($this->connection);
         $builder->addSelect($selects);
         return $builder;
    }






    /**
     * @inheritDoc
    */
    public function insert(string $table, array $attributes): InsertBuilder
    {
        $builder = new InsertBuilder($this->connection);
        $builder->insert($attributes)
                ->table($table);
        return $builder;
    }








    /**
     * @inheritDoc
    */
    public function update(string $table, array $attributes): UpdateBuilder
    {
        $builder = new UpdateBuilder($this->connection);
        $builder->update($attributes)
                ->table($table);
        return $builder;
    }







    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilder
    {
        $builder = new DeleteBuilder($this->connection);
        $builder->table($table);
        return $builder;
    }
}