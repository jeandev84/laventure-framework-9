<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;


use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditions;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\PaginatedQueryInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence\ObjectPersistence;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence\ObjectPersistenceInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\QueryHydrateInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;


/**
 * @inheritdoc
*/
class SelectBuilder extends BuilderConditions implements SelectBuilderInterface
{


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
    protected array $groupBy = [];




    /**
     * @var string[]
     */
    protected array $having = [];





    /**
     * @var array
     */
    protected array $orderBy = [];




    /**
     * @var int
     */
    protected int $offset = 0;




    /**s
     * @var int
    */
    protected int $limit = 0;





    /**
     * @var string|null
    */
    protected ?string $mappedClass = null;





    /**
     * @var int|null
     */
    protected ?int $fetchMode = Hydrate::ALL;





    /**
     * @var ObjectPersistenceInterface
    */
    protected ObjectPersistenceInterface $persistence;




    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
         parent::__construct($connection);
         $this->persistence = new ObjectPersistence();
    }








    /**
     * @inheritDoc
    */
    public function addSelect(string $selects): static
    {
         $this->selects[] = $selects;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function from(string $table, string $alias = ''): static
    {
        return $this->addFrom([$table => $alias]);
    }






    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = 'asc'): static
    {
         return $this->addOrderBy([$column => $direction]);
    }






    /**
     * @inheritDoc
     */
    public function join(string $table, string $condition): static
    {
         return $this->addJoinByType("JOIN", $table, $condition);
    }






    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->addJoinByType("INNER JOIN", $table, $condition);
    }





    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        return $this->addJoinByType("LEFT JOIN", $table, $condition);
    }





    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        return $this->addJoinByType("RIGHT JOIN", $table, $condition);
    }






    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
         return $this->addJoinByType("FULL JOIN", $table, $condition);
    }






    /**
     * @inheritDoc
    */
    public function groupBy(string $column): static
    {
         return $this->addGroupBy([$column]);
    }






    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
         return $this->addHaving([$condition]);
    }






    /**
     * @param array $conditions
     *
     * @return $this
    */
    public function addHaving(array $conditions): static
    {
        foreach ($conditions as $condition) {
            $this->having[] = $condition;
        }

        return $this;
    }






    /**
     * @inheritDoc
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
     * @inheritDoc
    */
    public function addJoins(array $joins, string $type = ''): static
    {
        if (array_key_exists($type, JoinType::$handlers)) {
             $func = JoinType::$handlers[$type];
             foreach ($joins as $table => $condition) {
                 call_user_func_array([$this, $func], [$table, $condition]);
             }
        } else {
            foreach ($joins as $join) {
                $this->addJoin($join);
            }
        }

        return $this;
    }






    /**
     * @param string $join
     *
     * @return $this
    */
    public function addJoin(string $join): static
    {
        $this->joins[] = $join;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addGroupBy(array $columns): static
    {
        foreach ($columns as $column) {
            $this->groupBy[] = $column;
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addOrderBy(array $orders): static
    {
         foreach ($orders as $column => $direction) {
             $this->orderBy[] = "$column $direction";
         }

         return $this;
    }






    /**
     * @param array $tables
     *
     * @return $this
    */
    public function addFrom(array $tables): static
    {
        foreach ($tables as $table => $alias) {
            $this->from[$table] = $alias ? "$table $alias" : $table;
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function map(string $classname): static
    {
         $this->mappedClass = $classname;

         return $this;
    }




    /**
     * @param int $fetch
     *
     * @return $this
    */
    public function fetchMode(int $fetch): static
    {
         $this->fetchMode = $fetch;

         return $this;
    }





    /**
     * @return QueryResultInterface
    */
    public function fetch(): QueryResultInterface
    {
          return $this->getStatement()->fetch();
    }






    /**
     * @inheritDoc
    */
    public function getQuery(): QueryHydrateInterface
    {
         $statement = $this->getStatement();

         return new Query($statement->fetch(), $this->persistence);
    }





    /**
     * @return QueryInterface
    */
    public function getStatement(): QueryInterface
    {
        $statement = parent::getStatement();
        $statement->setParameters($this->parameters);

        if ($this->mappedClass) {
            $statement->map($this->mappedClass);
        }

        return $statement;
    }







    /**
     * @inheritDoc
    */
    public function getPaginatedQuery(): PaginatedQueryInterface
    {
         return new PaginatedQuery($this);
    }







    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->selected()
                    ->joined()
                    ->grouped()
                    ->ordered()
                    ->limited()
                    ->buildQuery();
    }










    /**
     * @inheritdoc
    */
    public function getTable(): string
    {
        return join(', ', array_values($this->from));
    }





    /**
     * @inheritDoc
    */
    public function execute(): mixed
    {
        if (! array_key_exists($this->fetchMode, Hydrate::$handlers)) {
             return false;
        }

        $func = Hydrate::$handlers[$this->fetchMode];

        return call_user_func_array([$this->getQuery(), $func], []);
    }




    /**
     * @return int
    */
    public function count(): int
    {
        return $this->getQuery()->count();
    }





    /**
     * @return mixed
    */
    public function one(): mixed
    {
         return $this->getQuery()->getOneOrNullResult();
    }





    /**
     * @return array
    */
    public function all(): array
    {
          return $this->getQuery()->getResult();
    }





    /**
     * @return array
    */
    public function assoc(): array
    {
         return $this->getQuery()->getArrayResult();
    }





    /**
     * @return array
    */
    public function columns(): array
    {
         return $this->getQuery()->getArrayColumns();
    }






    /**
     * @inheritDoc
    */
    public function persistence(ObjectPersistenceInterface $persistence): static
    {
        $this->persistence = $persistence;

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function getPersistence(): ObjectPersistenceInterface
    {
        return $this->persistence;
    }





    /**
     * @return $this
    */
    private function selected(): static
    {
        $selects = join(', ', $this->selects);
        $command = sprintf('SELECT %s FROM %s', $selects, $this->getTable());
        return $this->addSQLPart($command);
    }






    /**
     * @return $this
    */
    private function joined(): static
    {
        if (! $this->joins) {
             return $this;
        }

        $this->addSQLPart(join(' ', $this->joins));

        return $this->addSQLConditions();
    }





    /**
     * @return $this
    */
    private function grouped(): static
    {
        if (! $this->groupBy) {
            return $this;
        }

        $group = $this->addSQLPart(sprintf('GROUP BY %s', join($this->groupBy)));

        if (! $this->having) {
            return $group;
        }

        return $this->addSQLPart(sprintf('HAVING %s', join($this->having)));
    }







    /**
     * @return $this
    */
    private function ordered(): static
    {
        if (!$this->orderBy) {
            return $this;
        }

        return $this->addSQLPart(sprintf('ORDER BY %s', join(',', $this->orderBy)));
    }





    /**
     * @return $this
    */
    private function limited(): static
    {
        if (! $this->limit) {
            return $this;
        }

        if ($this->offset) {
            return $this->addSQLPart("LIMIT {$this->limit} $this->offset");
        }

        return $this->addSQLPart("LIMIT {$this->limit}");
    }







    /**
     * @param string $type
     *
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    protected function addJoinByType(string $type, string $table, string $condition): static
    {
        return $this->addJoin("$type $table ON $condition");
    }
}