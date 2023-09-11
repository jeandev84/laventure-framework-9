<?php
namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\SelectBuilderInterface;
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
     * @return SelectBuilderInterface
    */
    public function select(string $selects = null): SelectBuilderInterface;






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
     * @return UpdateBuilderInterface
    */
    public function update(string $table, array $attributes): UpdateBuilderInterface;









    /**
     * @param string $table
     *
     * @return DeleteBuilderInterface
    */
    public function delete(string $table): DeleteBuilderInterface;
}