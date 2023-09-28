<?php
namespace Laventure\Component\Database\Connection\Query\Logger;

use Laventure\Component\Database\Connection\Query\QueryException;
use Laventure\Component\Database\Connection\Query\QueryExceptionInterface;
use Throwable;

/**
 * @QueryLoggerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query\Logger
*/
interface QueryLoggerInterface
{

      /**
       * @param string $sql
       *
       * @return mixed
      */
      public function logExecutedQuery(string $sql): mixed;

      
      
      

      /**
       * @param string $sql
       *
       * @param Throwable $e
       *
       * @return mixed
       *
       * @throws QueryExceptionInterface
      */
      public function logErrorQuery(string $sql, Throwable $e): mixed;
}