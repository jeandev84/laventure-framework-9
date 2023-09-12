<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnectionInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use RuntimeException;


/**
 * @Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
abstract class Builder
{

        /**
         * @var ConnectionInterface
        */
        protected ConnectionInterface $connection;



        /**
         * @var array
        */
        protected array $parts = [];




        /**
         * @var array
        */
        protected array $queries = [];






       /**
         * @param ConnectionInterface $connection
       */
       public function __construct(ConnectionInterface $connection)
       {
            $this->connection = $connection;
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
       public function getTableAlias(): string
       {
           return '';
       }





       /**
        * @return $this
       */
       public function executeQueries(): static
       {
           if ($this->queries) {
               foreach ($this->queries as $query) {
                   $this->connection->executeQuery($query);
               }
           }

           return $this;
       }




       /**
        * @return QueryInterface
       */
       public function getStatement(): QueryInterface
       {
            return $this->connection->statement($this->getSQL());
       }






       /**
        * @param string $sql
        * @return $this
       */
       public function addQuery(string $sql): static
       {
            $this->queries[] = $sql;

            return $this;
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
     protected function bind(array $attributes): array
     {
         return [];
     }







      /**
       * @param string $sql
       *
       * @return $this
      */
      protected function addSQLPart(string $sql): static
      {
            $this->parts[] = $sql;

            return $this;
      }





      /**
       * @return array
      */
      public function getParts(): array
      {
          return $this->parts;
      }




      /**
       * @return array
      */
      public function getQueries(): array
      {
          $this->queries[] = $this->getSQL();

          return $this->queries;
      }






     /**
      * @return string
     */
     public function __toString(): string
     {
         return $this->getSQL();
     }





    /**
     * @return string
    */
    protected function buildQuery(): string
    {
        return join(' ', array_filter($this->parts)) . ";";
    }





    /**
     * @return string
    */
    abstract public function getTable(): string;





    /**
     * @inheritdoc
    */
    abstract public function getSQL(): string;
}