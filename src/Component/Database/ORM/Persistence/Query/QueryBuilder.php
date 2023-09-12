<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Builder\SQL\SqlQueryBuilder;
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
      * @param string|null $selects
      *
      * @return SelectBuilder
     */
     public function select(string $selects = null): SelectBuilder
     {
         $builder = parent::select($selects);
         $builder->persistence($this->em);
         return $builder;
     }
}