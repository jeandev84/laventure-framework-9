<?php
namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\DeleteBuilderConditionInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\UpdateBuilderConditionInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\SelectBuilderConditionInterface;
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
     * @param string|null $selects
     *
     * @return SelectBuilderConditionInterface
    */
    public function select(string $selects = null): SelectBuilderConditionInterface;






    /**
     * @param string $table
     *
     * @param array $attributes
     *
     * @return InsertBuilderInterface
    */
    public function insert(string $table, array $attributes): InsertBuilderInterface;









    /**
     * @param string $table
     *
     * @param array $attributes
     *
     * @return UpdateBuilderConditionInterface
    */
    public function update(string $table, array $attributes): UpdateBuilderConditionInterface;









    /**
     * @param string $table
     *
     * @return DeleteBuilderConditionInterface
    */
    public function delete(string $table): DeleteBuilderConditionInterface;
}