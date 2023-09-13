<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract;


use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditionInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence\ObjectPersistenceInterface;

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
     * @param string $selects
     *
     * @return $this
    */
    public function addSelect(string $selects): static;






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
     * @param int $offset
     *
     * @return $this
    */
    public function setFirstResult(int $offset): static;






    /**
     * @param int $limit
     *
     * @return $this
    */
    public function setMaxResults(int $limit): static;








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








    /**
     * @param ObjectPersistenceInterface $persistence
     *
     * @return $this
    */
    public function persistence(ObjectPersistenceInterface $persistence): static;









    /**
     * @return ObjectPersistenceInterface
    */
    public function getPersistence(): ObjectPersistenceInterface;
}