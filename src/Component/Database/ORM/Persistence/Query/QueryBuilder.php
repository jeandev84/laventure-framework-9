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
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadata;


/**
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Query
*/
class QueryBuilder extends SqlQueryBuilder
{

     /**
      * @var EntityManager
     */
     protected EntityManager $em;




     /**
      * @param EntityManager $em
     */
     public function __construct(EntityManager $em)
     {
         parent::__construct($em->getConnection());
         $this->em = $em;
     }






     /**
      * Build select query
      *
      * @param string|null $selects
      * @param bool $distinct
      *
      * @return SelectBuilder
     */
     public function select(string $selects = null, bool $distinct = false): SelectBuilder
     {
           $builder = parent::select($selects && $distinct ? "DISTINCT $selects" : $selects);
           $builder->persistence($this->em);
           return $builder;
     }






     /**
      * @param string $context
      *
      * @param string $alias
      *
      * @return SelectBuilder
     */
     public function from(string $context, string $alias = ''): SelectBuilder
     {
         if (class_exists($context)) {
             $metadata = new ClassMetadata($context);
             return $this->select()
                         ->from($metadata->getTableName(), $alias)
                         ->map($context);
         }

         return $this->select()->from($context, $alias);
     }
}