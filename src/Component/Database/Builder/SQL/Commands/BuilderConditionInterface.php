<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;


use Laventure\Component\Database\Builder\SQL\Commands\Expr\Expr;

/**
 * @BuilderConditionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
interface BuilderConditionInterface extends BuilderInterface
{

      /**
       * @param string $condition
       *
       * @return $this
      */
      public function where(string $condition): static;






      /**
       * @param string $condition
       *
       * @return $this
      */
      public function andWhere(string $condition): static;






      /**
       * @param string $condition
       *
       * @return $this
      */
      public function orWhere(string $condition): static;








      /**
       * @param array $criteria
       *
       * @return $this
      */
      public function criteria(array $criteria): static;







      /**
       * @param string $name
       *
       * @param $value
       *
       * @return $this
      */
      public function setParameter(string $name, $value): static;







      /**
       * @param array $parameters
       * @return $this
      */
      public function setParameters(array $parameters): static;






      /**
       * @param array $conditions
       *
       * @param string $type
       *
       * @return $this
      */
      public function addConditions(string $type, array $conditions): static;










      /**
       * Returns queries part
       *
       * @return string
      */
      public function getSQLConditions(): string;
}