<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\Builder\SQL\Commands\DQL\JoinType;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\ORM\Persistence\EntityManager;


/**
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\EntityManager
*/
class Query
{

    /**
     * @param EntityManager $em
     *
     * @param QueryBuilder $sql
    */
    public function __construct(protected EntityManager $em, protected QueryBuilder $sql)
    {
    }




    /**
     * @return mixed
    */
    public function getResult(): mixed
    {
         return null;
    }




    /**
     * @return mixed
    */
    public function getOneOrNullResult(): mixed
    {
         return null;
    }




    /**
     * @return array
    */
    public function getArrayResult(): array
    {
         return [];
    }




    /**
     * @return array
    */
    public function getArrayColumns(): array
    {
         return [];
    }



    public function execute(): mixed
    {
          return null;
    }





    /**
     * @return string
    */
    public function getSQL(): string
    {
         $sql   = [];
         $sql[] = $this->selectQuery()->getSQL();
         return join(';', $sql);
    }






    /**
     * @return SelectBuilder
    */
    private function selectQuery(): SelectBuilder
    {
        /** @var SelectBuilder $qb */
        $qb = $this->em->getNamedQuery('select');
        return $qb->addSelect(join(', ', $this->sql['selects']))
                  ->addFrom($this->sql['from'])
                  ->addJoins($this->sql['joins'], JoinType::JOIN)
                  ->addJoins($this->sql['leftJoin'], JoinType::LEFT_JOIN)
                  ->addJoins($this->sql['rightJoin'], JoinType::RIGHT_JOIN)
                  ->addJoins($this->sql['innerJoin'], JoinType::INNER_JOIN)
                  ->addJoins($this->sql['fullJoin'], JoinType::FULL_JOIN)
                  ->addGroupBy($this->sql['groupBy'])
                  ->addHaving($this->sql['having'])
                  ->addOrderBy($this->sql['orderBy'])
                  ->addConditions('AND', $this->sql['wheres']['AND'])
                  ->addConditions('OR', $this->sql['wheres']['OR'])
                  ->limit($this->sql['limit'])
                  ->offset($this->sql['offset']);
    }






    /**
     * @param string $name
     *
     * @return bool
    */
    public function empty(string $name): bool
    {
        return ! empty($this->sql->toArray()[$name]);
    }
}