<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;


use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Builder\SQL\SqlQueryBuilder;
use Laventure\Component\Database\Builder\SQL\SqlQueryBuilderInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\EntityManager;


/**
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Query
*/
class QueryBuilder
{

     /**
      * @var EntityManager
     */
     protected EntityManager $em;




     /**
      * @var SqlQueryBuilder
     */
     protected SqlQueryBuilder $builder;



     /**
      * @param EntityManager $em
     */
     public function __construct(EntityManager $em)
     {
         $this->em      = $em;
         $this->builder = new SqlQueryBuilder($em->getConnection());
     }


     /**
      * @param string $selects
      *
      * @param bool $distinct
      *
      * @return SelectBuilder
     */
     public function select(string $selects = '*', bool $distinct = false): SelectBuilder
     {
           $selects = $distinct ? "DISTINCT $selects" : $selects;
           $builder = $this->builder->select($selects);
           $builder->persistence($this->em);
           return $builder;
     }






    /**
     * @param string $table
     *
     * @param array $attributes
     *
     * @return InsertBuilder
    */
    public function insert(string $table, array $attributes): InsertBuilder
    {
         return $this->builder->insert($table, $attributes);
    }




    /**
     * @param string $table
     *
     * @param array $attributes
     *
     * @return UpdateBuilder
    */
    public function update(string $table, array $attributes): UpdateBuilder
    {
         return $this->builder->update($table, $attributes);
    }





    /**
     * @param string $table
     *
     * @return DeleteBuilder
    */
    public function delete(string $table): DeleteBuilder
    {
         return $this->builder->delete($table);
    }
}