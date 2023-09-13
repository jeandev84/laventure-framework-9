<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditions;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\HasTable;
use Laventure\Component\Database\Connection\ConnectionInterface;


/**
 * @inheritdoc
*/
class UpdateBuilder extends BuilderConditions implements UpdateBuilderInterface
{


    use HasTable;


    /**
     * @var array
    */
    protected array $data = [];






    /**
     * @inheritDoc
    */
    public function update(array $attributes, array $wheres = []): static
    {
          foreach ($attributes as $column => $value) {
                $this->set($column, $value);
          }

          $this->criteria($wheres);

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
        return $this->getStatement()
                    ->setParameters($this->parameters)
                    ->execute();
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $bindings = sprintf('SET %s', join(', ', $this->data));

        return $this->addSQLPart(sprintf("UPDATE %s %s", $this->getTable(), $bindings))
                    ->addSQLConditions();
    }
}