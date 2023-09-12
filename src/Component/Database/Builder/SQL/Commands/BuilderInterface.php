<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;

/**
 * @BuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
interface BuilderInterface
{
      /**
       * Returns SQL
       *
       * @return string
      */
      public function getSQl(): string;






      /**
       * Returns table query building
       *
       * @return string
      */
      public function getTable(): string;







      /**
       * Returns table alias
       *
       * @return string
      */
      public function getTableAlias(): string;





      /**
       * Returns connection
       *
       * @return ConnectionInterface
     */
     public function getConnection(): ConnectionInterface;






    /**
     * @return QueryInterface
    */
    public function getStatement(): QueryInterface;
}