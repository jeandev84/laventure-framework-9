<?php
namespace Laventure\Component\Database\Connection\Query;


/**
 * @QueryResultInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query
*/
interface QueryResultInterface
{


    /**
     * Save the class name to fetch
     *
     * @param string $classname
     *
     * @return $this
    */
    public function map(string $classname): static;






    /**
     * Fetch all result
     *
     * @return mixed
    */
    public function all(): mixed;





    /**
     * Fetch one result
     *
     * @return mixed
    */
    public function one(): mixed;





    /**
     * Fetch result as array
     *
     * @return array
    */
    public function assoc(): array;





    /**
     * Fetch column
     *
     * @param int $column
     *
     * @return mixed
    */
    public function column(int $column = 0): mixed;






    /**
     * Fetch all columns
     *
     * @return mixed
    */
    public function columns(): mixed;








    /**
     * Returns rows count
     *
     * @return int
    */
    public function count(): int;
}