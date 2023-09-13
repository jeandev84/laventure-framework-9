<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditionInterface;
use Laventure\Component\Database\Builder\SQL\Commands\BuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\JoinType;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\Expr\Expr;
use Laventure\Component\Database\Builder\SQL\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\EntityManager;


/**
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Query
*/
class QueryBuilder implements \ArrayAccess
{


     /**
      * @var EntityManager
     */
     protected EntityManager $em;




     /**
      * @var array
     */
     protected array $selects = [];






     /**
      * @var array
     */
     protected array $from = [];





     /**
      * @var array
     */
     protected array $joins = [];





     /**
      * @var array
     */
     protected array $leftJoin = [];






     /**
      * @var array
     */
     protected array $rightJoin = [];






     /**
      * @var array
     */
     protected array $innerJoin = [];







     /**
      * @var array
     */
     protected array $fullJoin = [];






     /**
      * @var array
     */
     protected array $groupBy = [];






     /**
      * @var array
     */
     protected array $having = [];






     /**
      * @var array
     */
     protected array $orderBy = [];






     /**
      * @var int
     */
     protected int $limit = 0;






     /**
       * @var int
     */
     protected int $offset = 0;






     /**
      * @var array
     */
     protected array $insert = [];




     /**
      * @var array
     */
     protected array $update = [];




     /**
      * @var array
     */
     protected array $set = [];





     /**
      * @var array|string[]
     */
     protected array $delete = [];





     /**
      * @var array
     */
     protected array $wheres = [
         'AND' => [],
         'OR'  => []
     ];





     /**
      * @var array
     */
     protected array $parameters = [];







     /**
      * @param EntityManager $em
     */
     public function __construct(EntityManager $em)
     {
           $this->em  = $em;
     }


     /**
      * @param array|string $selects
      *
      * @return $this
     */
     public function select(array|string $selects = ''): static
     {
           return $this->addSelect($selects);
     }







     /**
      * @param string $table
      *
      * @param string $alias
      *
      * @return $this
     */
     public function from(string $table, string $alias = ''): static
     {
          $this->from[$table] = $alias;

          return $this;
     }






     /**
      * @param string $table
      *
      * @param string $condition
      *
      * @return $this
      */
     public function join(string $table, string $condition): static
     {
           $this->joins[] = [$table => $condition];

           return $this;
     }







    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function innerJoin(string $table, string $condition): static
    {
        $this->innerJoin[] = [$table => $condition];

        return $this;
    }






    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
     */
    public function leftJoin(string $table, string $condition): static
    {
        $this->leftJoin[] = [$table => $condition];

        return $this;
    }






    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
     */
    public function rightJoin(string $table, string $condition): static
    {
         $this->rightJoin[] = [$table => $condition];

         return $this;
    }







    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
     */
    public function fullJoin(string $table, string $condition): static
    {
        $this->fullJoin[] = [$table => $condition];

        return $this;
    }






     /**
      * @param string $column
      *
      * @param string $direction
      *
      * @return $this
     */
     public function orderBy(string $column, string $direction = 'asc'): static
     {
          return $this->addOrderBy([$column => $direction]);
     }






    /**
     * @param string $column
     *
     * @return $this
    */
    public function groupBy(string $column): static
    {
         return $this->addGroupBy([$column]);
    }







    /**
     * @param string $condition
     *
     * @return $this
    */
    public function having(string $condition): static
    {
         $this->having[] = $condition;

         return $this;
    }







    /**
     * @param int $limit
     *
     * @return $this
    */
    public function setMaxResults(int $limit): static
    {
         $this->limit = $limit;

         return $this;
    }





    /**
     * @param int $offset
     *
     * @return $this
    */
    public function setFirstResult(int $offset): static
    {
          $this->offset = $offset;

          return $this;
    }




    /**
     * @param string $table
     *
     * @param string $alias
     *
     * @return $this
    */
    public function update(string $table, string $alias = ''): static
    {
        $this->update[$table] = $alias;

        return $this;
    }





    /**
     * @param string $name
     *
     * @param $value
     *
     * @return $this
    */
    public function set(string $name, $value): static
    {
         $this->set[$name] = $value;

         return $this;
    }





    /**
     * @param string $table
     *
     * @param array $attributes
     *
     * @return $this
    */
    public function insert(string $table, array $attributes): static
    {
          $this->insert[$table] = $attributes;

          return $this;
    }





    /**
     * @param string $table
     *
     * @param string $alias
     *
     * @return $this
    */
    public function delete(string $table, string $alias = ''): static
    {
          $this->delete[$table] = $alias;

          return $this;
    }






    /**
     * @param string $condition
     *
     * @return $this
    */
    public function where(string $condition): static
    {
         return $this->andWhere($condition);
    }






    /**
     * @param string $condition
     *
     * @return $this
    */
    public function andWhere(string $condition): static
    {
        $this->wheres['AND'][] = $condition;

        return $this;
    }





    /**
     * @param string $condition
     *
     * @return $this
    */
    public function orWhere(string $condition): static
    {
          $this->wheres['OR'][] = $condition;

          return $this;
    }




    /**
     * @param string $name
     *
     * @param $value
     *
     * @return $this
    */
    public function setParameter(string $name, $value): static
    {
          $this->parameters[$name] = $value;

          return $this;
    }




    /**
     * @param array $parameters
     *
     * @return $this
    */
    public function setParameters(array $parameters): static
    {
         $this->parameters = array_merge($this->parameters, $parameters);

         return $this;
    }






    /**
     * @return string
    */
    public function getSQl(): string
    {
         return $this->getQuery()->getSQL();
    }







    /**
     * @return Query
    */
    public function createQuery(): Query
    {
        return new Query($this->em, $this);
    }






    /**
     * @return Query
    */
    public function getQuery(): Query
    {
         $this->em->addNamedQueries($this->getBuilders());

         return $this->createQuery();
    }







    /**
     * @return Expr
    */
    public function expr(): Expr
    {
         return new Expr();
    }





    /**
     * @param array|string $select
     *
     * @return $this
    */
    public function addSelect(array|string $select): static
    {
          $this->selects[] = $select;

          return $this;
    }







    /**
     * @param array $joins
     *
     * @return $this
    */
    public function addJoin(array $joins): static
    {
        foreach ($joins as $join) {
            $this->joins['join'][] = $join;
        }
        return $this;
    }





    /**
     * @param array $columns
     *
     * @return $this
    */
    public function addGroupBy(array $columns): static
    {
        foreach ($columns as $column) {
            $this->groupBy[$column] = $column;
        }

        return $this;
    }






    /**
     * @param array $orders
     *
     * @return $this
    */
    public function addOrderBy(array $orders): static
    {
        foreach ($orders as $column => $direction) {
             $this->orderBy[] = [$column => $direction];
        }

        return $this;
    }





    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
         return $this->em->getConnection();
    }






    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
         return property_exists($this, $offset);
    }






    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
         if (! $this->offsetExists($offset)) {
              return null;
         }

         return $this->{$offset};
    }






    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
         if ($this->offsetExists($offset)) {
             $this->{$offset} = $value;
         }
    }




    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
         if ($this->offsetExists($offset)) {
             unset($this->{$offset});
         }
    }





    /**
     * @return array
    */
    public function toArray(): array
    {
         $data = get_object_vars($this);
         unset($data['em']);
         return $data;
    }






    /**
     * @return BuilderInterface[]
    */
    private function getBuilders(): array
    {
         return [
               'select'  => new SelectBuilder($this->getConnection()),
               'insert'  => new InsertBuilder($this->getConnection()),
               'update'  => new UpdateBuilder($this->getConnection()),
               'delete'  => new DeleteBuilder($this->getConnection())
         ];
    }
}