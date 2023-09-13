<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
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


    const HYDRATE_ALL     = 'HYDRATE_ALL';
    const HYDRATE_ONE     = 'HYDRATE_ONE';
    const HYDRATE_ARRAY   = 'HYDRATE_ARRAY';
    const HYDRATE_COLUMNS = 'HYDRATE_COLUMNS';




    /**
     * @var array
    */
    protected array $queries = [];





    /**
     * @param EntityManager $em
     *
     * @param QueryBuilder $builder
    */
    public function __construct(protected EntityManager $em, protected QueryBuilder $builder)
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




    /**
     * @param string|null $type
     *
     * @return mixed
    */
    public function execute(string $type = null): mixed
    {
           switch ($type):
               case self::HYDRATE_ALL:
                    $objects = $this->selectQuery()
                                    ->getQuery()
                                    ->getResult();

               case self::HYDRATE_ONE:
               case self::HYDRATE_ARRAY:
               case self::HYDRATE_COLUMNS:
           endswitch;
    }




    /**
     * @param string $sql
     *
     * @param array $params
     *
     * @return $this
    */
    public function addSql(string $sql, array $params = []): static
    {
         $this->queries[] = [$sql => $params];

         return $this;
    }






    /**
     * @return string
    */
    public function getSQL(): string
    {
         return join(';', $this->getQueries());
    }










    /**
     * @return SelectBuilder
    */
    private function selectQuery(): SelectBuilder
    {
        $qb = new SelectBuilder($this->em->getConnection());
        return $qb->addSelect(join(', ', $this->builder['selects']))
                  ->addFrom($this->builder['from'])
                  ->addJoins($this->builder['joins'], JoinType::JOIN)
                  ->addJoins($this->builder['leftJoin'], JoinType::LEFT_JOIN)
                  ->addJoins($this->builder['rightJoin'], JoinType::RIGHT_JOIN)
                  ->addJoins($this->builder['innerJoin'], JoinType::INNER_JOIN)
                  ->addJoins($this->builder['fullJoin'], JoinType::FULL_JOIN)
                  ->addGroupBy($this->builder['groupBy'])
                  ->addHaving($this->builder['having'])
                  ->addOrderBy($this->builder['orderBy'])
                  ->addConditions($this->andWheres(), 'AND')
                  ->addConditions($this->orWheres(), 'OR')
                  ->limit($this->builder['limit'])
                  ->offset($this->builder['offset'])
                  ->setParameters($this->builder['parameters']);
    }





    /**
     * @return array
    */
    private function andWheres(): array
    {
        return $this->builder['wheres']['AND'];
    }





    /**
     * @return array
    */
    private function orWheres(): array
    {
        return $this->builder['wheres']['OR'];
    }




    /**
     * @return array
    */
    private function getQueries(): array
    {
        $this->queries[] = $this->selectQuery()->getSQL();
        return $this->queries;
    }

}