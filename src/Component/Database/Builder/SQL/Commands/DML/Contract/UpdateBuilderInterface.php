<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditionInterface;



/**
 * @UpdateBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DML\Contract
*/
interface UpdateBuilderInterface extends BuilderConditionInterface
{

      /**
       * @param array $attributes
       *
       * @param array $wheres
       *
       * @return static
      */
      public function update(array $attributes, array $wheres = []): static;






      /**
       * @param string $table
       *
       * @param string $alias
       *
       * @return $this
      */
      public function table(string $table, string $alias = ''): static;








      /**
       * @param string $name
       *
       * @param $value
       *
       * @return $this
      */
      public function set(string $name, $value): static;









      /**
       * @return bool
      */
      public function execute(): bool;
}