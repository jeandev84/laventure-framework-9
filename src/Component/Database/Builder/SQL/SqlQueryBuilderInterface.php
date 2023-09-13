<?php
namespace Laventure\Component\Database\Builder\SQL;


use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;


/**
 * @SqlQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL
*/
interface SqlQueryBuilderInterface
{

    /**
     * @param string|array $selects
     *
     * @return SelectBuilder
    */
    public function select(string|array $selects = '*'): SelectBuilder;






    /**
     * @param string $table
     *
     * @param array $attributes
     *
     * @return InsertBuilder
    */
    public function insert(string $table, array $attributes): InsertBuilder;









    /**
     * @param string $table
     *
     * @param array $attributes
     *
     * @return UpdateBuilder
    */
    public function update(string $table, array $attributes): UpdateBuilder;









    /**
     * @param string $table
     *
     * @return DeleteBuilder
    */
    public function delete(string $table): DeleteBuilder;
}