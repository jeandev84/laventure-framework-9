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
     * @inheritDoc
    */
    public function execute(): int
    {

    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $columns = join(', ', $this->getColumns());
        $values  = join(', ', $this->getValues());
        return $this->addSQL(sprintf("INSERT INTO {$this->getTable()} (%s) VALUES %s", $columns, $values));
    }






    /**
     * @param array $data
     *
     * @return $this
    */
    public function attributes(array $data): static
    {
          if (empty($data[0])) {
               $this->insert($data);
          } else {
              foreach ($data as $attributes) {
                  $this->insert($attributes);
              }
          }

          return $this;
    }






    /**
     * @return array
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }




    /**
     * @return array
    */
    public function getColumns(): array
    {
        return $this->columns;
    }




    /**
     * @return array
    */
    public function getValues(): array
    {
        return $this->values;
    }






    /**
     * @param array $attributes
     *
     * @return array
    */
    private function bind(array $attributes): array
    {
        $resolved = [];

        foreach ($attributes as $column => $value) {
            if ($this->hasPdoConnection()) {
                $resolved[$column] = ":{$column}_{$this->index}";
                $this->attributes["{$column}_{$this->index}"] = $value;
            } else {
                $resolved[$column] = "'$value'";
            }
        }

        return $resolved;
    }

}