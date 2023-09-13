<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;


use Laventure\Component\Database\Builder\SQL\Commands\BuilderInterface;

/**
 * @InsertBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DML\Contract
*/
interface InsertBuilderInterface extends BuilderInterface
{

       /**
        * @param array $attributes
        *
        * @return $this
       */
       public function insert(array $attributes): static;





       /**
        * @param string $table
        *
        * @param string $alias
        *
        * @return $this
       */
       public function table(string $table, string $alias = ''): static;








       /**
        * Returns count of insertion
        *
        * @return int
       */
       public function count(): int;






      /**
       * Returns insertion attributes
       *
       * @return array
      */
      public function getAttributes(): array;






    /**
     * Must returns last inserted ID
     *
     * @return int
    */
    public function execute(): int;
}