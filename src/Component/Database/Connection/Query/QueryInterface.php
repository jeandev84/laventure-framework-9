<?php
namespace Laventure\Component\Database\Connection\Query;


/**
 * @QueryHydrateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query
*/
interface QueryInterface
{
    const NULL = 0;
    const INT  = 1;
    const STR  = 2;
    const BOOL = 3;




    /**
     * Prepare sql statement
     *
     * @param string $sql
     *
     * @return $this
    */
    public function prepare(string $sql): static;





    /**
     * Bind query params
     *
     * @param $name
     *
     * @param $value
     *
     * @param int $type
     *
     * @return $this
    */
    public function bindParam($name, $value, int $type): static;






    /**
     * Bind query values
     *
     * @param $name
     *
     * @param $value
     *
     * @param int $type
     *
     * @return $this
    */
    public function bindValue($name, $value, int $type): static;









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
     * @param string $classname
     *
     * @return $this
    */
    public function map(string $classname): static;






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
     * @return QueryLogger
    */
    public function getLogger(): QueryLogger;
}