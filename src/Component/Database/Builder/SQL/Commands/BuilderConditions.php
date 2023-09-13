<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;


use Laventure\Component\Database\Builder\SQL\Commands\Expr\Expr;

/**
 * @inheritdoc
*/
abstract class BuilderConditions extends Builder implements BuilderConditionInterface
{

      const AND = 'AND';
      const OR  = 'OR';



      /**
       * @var array|string[]
      */
      protected array $types = [
          'AND' => 'andWhere',
          'OR'  => 'orWhere'
      ];




      /**
       * @var array
      */
      protected array $wheres = [];




      /**
       * @var array
      */
      protected array $parameters = [];





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
     * @inheritdoc
    */
    public function addConditions(string $type, array $conditions): static
    {
         foreach ($this->types as $index => $func) {
             if ($type === $index) {
                 foreach ($conditions as $condition) {
                      call_user_func_array([$this, $func], [$condition]);
                 }
             }
         }

         return $this;
    }






    /**
     * @param array $conditions
     *
     * @return $this
     */
    public function andWheres(array $conditions): static
    {
        foreach ($conditions as $condition) {
            $this->andWhere($condition);
        }

        return $this;
    }






    /**
     * @param array $conditions
     *
     * @return $this
    */
    public function orWheres(array $conditions): static
    {
        foreach ($conditions as $condition) {
            $this->orWhere($condition);
        }

        return $this;
    }





    /**
     * @param array $criteria
     *
     * @return $this
    */
    public function criteria(array $criteria): static
    {
        foreach ($criteria as $column => $value) {
            if ($this->hasPdoConnection()) {
                $this->criteriaPdo($column, $value);
            } else {
                $this->where("$column = '$value'");
            }
        }

        return $this;
    }





    /**
     * @return Expr
    */
    public function expr(): Expr
    {
        return new Expr();
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
         return $this->setParameters([$name => $value]);
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
     * @return array
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }





    /**
     * @inheritdoc
    */
    public function getSQLConditions(): string
    {
        if (! $this->wheres) { return '';}

        $wheres = [];

        $key = key($this->wheres);

        foreach ($this->wheres as $operand => $conditions) {
            if ($key !== $operand) {
                $wheres[] = $operand;;
            }
            $wheres[] = join(" $operand ", $conditions);
        }

        return sprintf('WHERE %s', join(' ', $wheres));
    }





    /**
     * @return $this
    */
    protected function addSQLConditions(): static
    {
        return $this->addSQLPart($this->getSQLConditions());
    }




    /**
     * @param string $column
     *
     * @param $value
     *
     * @return void
    */
    private function criteriaPdo(string $column, $value)
    {
        if (is_array($value)) {
            $this->where($this->expr()->in($column, "(:$column)"));
            $this->setParameter($column, $value);
        } else {
            $this->where("$column = :$column");
            $this->setParameter($column, $value);
        }
    }
}