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
          foreach ($attributes as $column => $value) {
                $this->set($column, $value);
          }

          return $this;
    }






    /**
     * @inheritDoc
    */
    public function set(string $name, $value): static
    {
        if ($this->hasPdoConnection()) {
            $this->data[$name] = "$name = :$name";
            $this->setParameter($name, $value);
        } else {
            $this->data[$name] = "$name = '$value'";
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
        return $this->statement()
                    ->setParameters($this->parameters)
                    ->execute();
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $bindings = sprintf('SET %s', join(', ', $this->data));

        return $this->addSQL(sprintf("UPDATE %s %s", $this->getTable(), $bindings))
                    ->addConditions();
    }
}