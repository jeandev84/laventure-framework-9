<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;


/**
 * @inheritdoc
*/
abstract class BuilderConditions extends Builder
{


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
           return $this;
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
     * @param array $criteria
     *
     * @return $this
    */
    public function criteria(array $criteria): static
    {
         return $this;
    }





    public function expr()
    {

    }




    /**
     * @return string
    */
    protected function getSQLConditions(): string
    {
         return '';
    }




    /**
     * @return $this
    */
    public function conditions(): static
    {
        return $this->addSQL($this->getSQLConditions());
    }
}