<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderConditionInterface;

/**
 * @UpdateBuilderConditionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DML\Contract
*/
interface UpdateBuilderConditionInterface extends BuilderConditionInterface
{

      /**
       * @param array $attributes
       *
       * @return static
      */
      public function update(array $attributes): static;





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