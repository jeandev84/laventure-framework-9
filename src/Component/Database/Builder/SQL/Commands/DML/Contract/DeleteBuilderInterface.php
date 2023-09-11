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
interface DeleteBuilderInterface
{

      /**
       * @param array $wheres
       *
       * @return static
      */
      public function delete(array $wheres = []): static;






      /**
       * @return bool
      */
      public function execute(): bool;
}