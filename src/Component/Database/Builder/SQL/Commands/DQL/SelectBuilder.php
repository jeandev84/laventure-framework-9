<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;


use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditions;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\PaginatedQueryInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence\NullObjectPersistence;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence\ObjectPersistenceInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\QueryHydrateInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;



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
     * @var string
    */
    protected string $mappedClass;




    /**
     * @var ObjectPersistenceInterface
    */
    protected ObjectPersistenceInterface $persistence;



    /**
     * @param ConnectionInterface $connection
     *
     * @param string|null $selects
    */
    public function __construct(ConnectionInterface $connection, string $selects = null)
    {
         parent::__construct($connection);
         $this->addSelect($selects ?: "*");
         $this->persistence = new NullObjectPersistence();
    }








    /**
     * @inheritDoc
    */
    public function addSelect(string|array $select): static
    {
         $this->selects[] = $this->resolveSelects($select);

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function from(string $table, string $alias = ''): static
    {
        $this->from[$table] = $this->resolveFrom($table, $alias);
        $this->table = $table;
        $this->alias = $alias;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = 'asc'): static
    {
         return $this->addOrderBy(["$column $direction"]);
    }






    /**
     * @inheritDoc
     */
    public function join(string $table, string $condition): static
    {
         return $this->joins("JOIN", $table, $condition);
    }






    /**
     * @inheritDoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->joins("INNER JOIN", $table, $condition);
    }





    /**
     * @inheritDoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        return $this->joins("LEFT JOIN", $table, $condition);
    }





    /**
     * @inheritDoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        return $this->joins("RIGHT JOIN", $table, $condition);
    }






    /**
     * @inheritDoc
    */
    public function fullJoin(string $table, string $condition): static
    {
         return $this->joins("FULL JOIN", $table, $condition);
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
         $this->having[] = $condition;

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function limit(int $limit): static
    {
          $this->limit = $limit;

          return $this;
    }





    /**
     * @param int $offset
     *
     * @return $this
    */
    public function offset(int $offset): static
    {
         $this->offset = $offset;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function addJoin(array $joins): static
    {
        foreach ($joins as $join) {
            $this->joins[] = $join;
        }

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
         foreach ($orders as $ordered) {
             $this->orderBy[] = $ordered;
         }

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function map(string $classname): static
    {
         $this->getStatement()->map($classname);

         return $this;
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
    public function getQuery(): QueryHydrateInterface
    {
         return new Query($this->getStatement()->fetch(), $this->persistence);
    }







    /**
     * @inheritDoc
    */
    public function getPaginatedQuery(): PaginatedQueryInterface
    {
         return new PaginatedQuery($this);
    }





    /**
     * @inheritdoc
    */
    public function getPersistence(): ObjectPersistenceInterface
    {
        return $this->persistence;
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
     * @return $this
    */
    private function selected(): static
    {
        $selects = join(', ', $this->selects);
        $command = sprintf('SELECT %s FROM %s', $selects, $this->fromTables());
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

        return $this->addConditions();
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
     * @param string $table
     *
     * @param string $alias
     *
     * @return string
    */
    protected function resolveFrom(string $table, string $alias = ''): string
    {
         return $alias ? "$table $alias" : $table;
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
    protected function joins(string $type, string $table, string $condition): static
    {
        return $this->addJoin(["$type $table ON $condition"]);
    }






    /**
     * @param string|array $selects
     *
     * @return string
    */
    private function resolveSelects(string|array $selects): string
    {
          return is_array($selects) ? join(', ', $selects) : $selects;
    }





    /**
     * @return string
    */
    private function fromTables(): string
    {
        return join(', ', array_values($this->from));
    }
}