<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditions;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\UpdateBuilderInterface;


/**
 * @inheritdoc
*/
class UpdateBuilder extends BuilderConditions implements UpdateBuilderInterface
{


    /**
     * @var array
    */
    protected array $data = [];






    /**
     * @inheritDoc
    */
    public function update(array $attributes): static
    {
          $this->data = $this->bind($attributes);

          return $this->setParameters($attributes);
    }






    /**
     * @inheritDoc
    */
    public function set(string $name, $value): static
    {
        $this->data[$name] = $value;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function execute(): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $bindings = sprintf('SET %s', join(', ', $this->data));

        return $this->addSQL(sprintf("UPDATE %s %s", $this->getTable(), $bindings))
                    ->addSQLConditions();
    }







    /**
     * @param array $attributes
     *
     * @return array
    */
    protected function bind(array $attributes): array
    {
        $bindings = [];

        foreach ($attributes as $column => $value) {
            if ($this->hasPdoConnection()) {
                $bindings[] = "$column = :$column";
            } else {
                $bindings[] = "$column = '$value'";
            }
        }

        return $bindings;
    }
}