<?php
namespace Laventure\Component\Database\Connection\Query;


use Laventure\Component\Database\Connection\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Connection\Query\Result\QueryResultInterface;

/**
 * @QueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query
*/
interface QueryInterface
{
    const PARAM_NULL = 0;
    const PARAM_INT  = 1;
    const PARAM_STR  = 2;
    const PARAM_BOOL = 3;




    /**
     * Prepare sql statement
     *
     * @param string $sql
     *
     * @return $this
    */
    public function prepare(string $sql): static;







    /**
     * @param string $classname
     *
     * @return $this
    */
    public function map(string $classname): static;







    /**
     * @param array $params
     *
     * @return $this
    */
    public function bindParams(array $params): static;








    /**
     * Bind values
     *
     * @param array $values
     * @return $this
    */
    public function bindValues(array $values): static;









    /**
     * Bind columns
     *
     * @param array $columns
     *
     * @return $this
    */
    public function bindColumns(array $columns): static;








    /**
     * Set params to execute
     *
     * @param array $parameters
     *
     * @return $this
    */
    public function setParameters(array $parameters): static;







    /**
     * Execute query
     *
     * Returns last insert id or boolean
     *
     * @return mixed
    */
    public function execute(): mixed;








    /**
     * Execute query
     *
     * @param string $sql
     *
     * @return mixed
    */
    public function exec(string $sql): mixed;









    /**
     * Fetch Result
     *
     * @return QueryResultInterface
    */
    public function fetch(): QueryResultInterface;








    /**
     * Returns last inserted ID
     *
     * @return int
    */
    public function lastId(): int;








    /**
     * Returns current query
     *
     * @return string
    */
    public function getSQL(): string;









    /**
     * Returns executed queries
     *
     * @return QueryLoggerInterface
    */
    public function getLogger(): QueryLoggerInterface;
}