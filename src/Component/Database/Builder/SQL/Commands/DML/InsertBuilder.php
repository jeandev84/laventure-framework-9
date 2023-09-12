<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;


use Laventure\Component\Database\Builder\SQL\Commands\Builder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\InsertBuilderInterface;


/**
 * @inheritdoc
*/
class InsertBuilder extends Builder implements InsertBuilderInterface
{

    /**
     * @var int
    */
    protected int $index = 0;



    /**
     * @var array
    */
    protected array $attributes = [];




    /**
     * @var array
    */
    protected array $columns = [];






    /**
     * @var array
    */
    protected array $values = [];






    /**
     * @inheritDoc
    */
    public function insert(array $attributes): static
    {
         $attributes     = $this->bind($attributes);
         $this->columns  = array_keys($attributes);
         $this->values[] = '('. join(', ', array_values($attributes)) . ')';

         $this->index++;
         return $this;
    }




    /**
     * @param string $table
     *
     * @param string $alias
     *
     * @return $this
    */
    public function table(string $table, string $alias = ''): static
    {
        return parent::table($table, $alias);
    }









    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $columns = join(', ', $this->columns());
        $values  = join(', ', $this->values());
        return $this->addSQLPart(sprintf("INSERT INTO {$this->getTable()} (%s) VALUES %s", $columns, $values));
    }






    /**
     * Multi insertion
     *
     * @param array $data
     *
     * @return $this
    */
    public function attributes(array $data): static
    {
          if (! empty($data[0])) {
              foreach ($data as $attributes) {
                  $this->insert($attributes);
              }
          } else {
              $this->insert($data);
          }

          return $this;
    }







    /**
     * @inheritDoc
    */
    public function execute(): int
    {
        return $this->getStatement()
                   ->setParameters($this->attributes)
                   ->execute();
    }







    /**
     * @inheritdoc
    */
    public function count(): int
    {
        return $this->index;
    }







    /**
     * @inheritdoc
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }







    /**
     * @inheritdoc
    */
    protected function bind(array $attributes): array
    {
        $bindings = [];
        foreach ($attributes as $column => $value) {
            if ($this->hasPdoConnection()) {
                $bindings[$column] = ":{$column}_{$this->index}";
                $this->attributes["{$column}_{$this->index}"] = $value;
            } else {
                $bindings[$column] = "'$value'";
            }
        }
        return $bindings;
    }





    /**
     * @return array
    */
    protected function columns(): array
    {
        return $this->columns;
    }




    /**
     * @return array
    */
    protected function values(): array
    {
        return $this->values;
    }
}