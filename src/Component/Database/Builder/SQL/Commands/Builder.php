<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnectionInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;


/**
 * @Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
abstract class Builder implements BuilderInterface
{

        /**
         * @var ConnectionInterface
        */
        protected ConnectionInterface $connection;




        /**
         * @var string
        */
        protected string $table;





        /**
         * @var string
        */
        protected string $alias;





        /**
         * @var array
        */
        protected array $sql = [];






       /**
         * @param ConnectionInterface $connection
         *
         * @param string $table
         *
         * @param string $alias
       */
       public function __construct(ConnectionInterface $connection, string $table = '', string $alias = '')
       {
            $this->connection = $connection;
            $this->table      = $table;
            $this->alias      = $alias;
       }







       /**
        * @inheritDoc
       */
       public function getConnection(): ConnectionInterface
       {
              return $this->connection;
       }







       /**
        * @return string
       */
       public function getTable(): string
       {
           return $this->table;
       }






       /**
        * @return string
       */
       public function getTableAlias(): string
       {
           return $this->alias;
       }





       /**
        * @return QueryInterface
       */
       public function getStatement(): QueryInterface
       {
            return $this->connection->statement($this->getSQL());
       }






      /**
       * @return bool
      */
      protected function hasPdoConnection(): bool
      {
           return $this->connection instanceof PdoConnectionInterface;
      }






     /**
       * @param array $attributes
       *
       * @return array
     */
     protected function getBindings(array $attributes): array
     {
         return [];
     }







      /**
       * @param string $sql
       *
       * @return $this
      */
      public function addSQL(string $sql): static
      {
            $this->sql[] = $sql;

            return $this;
      }






     /**
      * Returns SQL query
      *
      * @return string
     */
     public function getSQL(): string
     {
          return $this->__toString();
     }





     /**
      * @return string
     */
     public function __toString(): string
     {
         return $this->getSQL();
         # return join(' ', array_filter($this->sql)) . ";";
     }
}