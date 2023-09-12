<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditionInterface;


/**
 * @DeleteBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DML\Contract
*/
interface DeleteBuilderInterface extends BuilderConditionInterface
{

      /**
       * @param array $wheres
       *
       * @return static
      */
      public function delete(array $wheres = []): static;







      /**
       * @param string $table
       *
       * @param string $alias
       *
       * @return $this
      */
      public function table(string $table, string $alias = ''): static;






      /**
       * @return bool
      */
      public function execute(): bool;
}