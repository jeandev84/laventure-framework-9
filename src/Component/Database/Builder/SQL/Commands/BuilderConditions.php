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
      protected array $func = [
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
     * @param string $type
     * @param array $conditions
     *
     * @return $this
    */
    public function addCondition(string $type, array $conditions): static
    {
        foreach ($conditions as $condition) {
            if (array_key_exists($type, $this->func)) {
                $func = $this->func[$type];
                call_user_func_array([$this, $func], [$condition]);
            } else {
                $this->andWhere($condition);
            }
        }

         return $this;
    }






    /**
     * @inheritdoc
    */
    public function addConditions(array $conditions): static
    {
        foreach ($conditions as $type => $criteria) {
             $this->addCondition($type, $criteria);
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
        return $this->addConditions(['AND' => $conditions]);
    }






    /**
     * @param array $conditions
     *
     * @return $this
    */
    public function orWheres(array $conditions): static
    {
        return $this->addConditions(['OR' => $conditions]);
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
         foreach ($parameters as $name => $value) {
             $this->setParameter($name, $value);
         }

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
     * @return $this
    */
    private function criteriaPdo(string $column, $value): static
    {
        if (is_array($value)) {
            $this->where($this->expr()->in($column, "(:$column)"));
            $this->setParameter($column, $value);
        } else {
            $this->where("$column = :$column");
            $this->setParameter($column, $value);
        }

        return $this;
    }
}