<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract;


use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditionInterface;

/**
 * @SelectBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract
*/
interface SelectBuilderInterface extends BuilderConditionInterface
{

    /**
     * @param string|array $select
     *
     * @return $this
    */
    public function addSelect(string|array $select): static;






    /**
     * @param array $joins
     *
     * @return $this
    */
    public function addJoins(array $joins): static;







    /**
     * @param array $columns
     *
     * @return $this
    */
    public function addGroupBy(array $columns): static;






    /**
     * @param array $orders
     *
     * @return $this
    */
    public function addOrderBy(array $orders): static;








    /**
     * @param string $table
     *
     * @param string $alias
     *
     * @return $this
    */
    public function from(string $table, string $alias = ''): static;






    /**
     * @param string $column
     *
     * @param string $direction
     *
     * @return $this
    */
    public function orderBy(string $column, string $direction = 'asc'): static;






    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function join(string $table, string $condition): static;







    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function innerJoin(string $table, string $condition): static;







    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function leftJoin(string $table, string $condition): static;









    /**
     * @param string $table
     * @param string $condition
     * @return $this
    */
    public function rightJoin(string $table, string $condition): static;








    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function fullJoin(string $table, string $condition): static;







    /**
     * @param string $column
     *
     * @return $this
    */
    public function groupBy(string $column): static;








    /**
     * @param string $condition
     *
     * @return $this
    */
    public function having(string $condition): static;








    /**
     * @param int $limit
     *
     * @return $this
    */
    public function limit(int $limit): static;





    /**
     * @param int $offset
     *
     * @return $this
    */
    public function offset(int $offset): static;






    /**
     * @param string $classname
     *
     * @return $this
    */
    public function map(string $classname): static;







    /**
     * @return QueryHydrateInterface
    */
    public function getQuery(): QueryHydrateInterface;







    /**
     * @return PaginatedQueryInterface
    */
    public function getPaginatedQuery(): PaginatedQueryInterface;
}