<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\JoinType;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
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
    protected array $executed = [];




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
         return $this->execute(self::HYDRATE_ALL);
    }





    /**
     * @return mixed
    */
    public function getOneOrNullResult(): mixed
    {
         return $this->execute(self::HYDRATE_ONE);
    }




    /**
     * @return array
    */
    public function getArrayResult(): array
    {
         return $this->execute(self::HYDRATE_ARRAY);
    }




    /**
     * @return array
    */
    public function getArrayColumns(): array
    {
         return $this->execute(self::HYDRATE_COLUMNS);
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
                    $objects = $this->all();
                    foreach ($objects as $object) {
                        $this->em->persist($object);
                    }
                    return $objects;
               case self::HYDRATE_ONE:
                   $object = $this->one();
                   $this->em->persist($object);
                   return $object;
               case self::HYDRATE_ARRAY:
                   return $this->assoc();
               case self::HYDRATE_COLUMNS:
                   return $this->columns();
               default:
                   throw new \RuntimeException('Could not resolve this execution');
           endswitch;
    }





    /**
     * @return string
    */
    public function getSQL(): string
    {
         return join(';', $this->getQueries());
    }





    private function executeQuery(): int|bool
    {

    }




    /**
     * @return SelectBuilder
    */
    private function select(): SelectBuilder
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
                  ->setParameters($this->getParameters());
    }





    private function insert(): InsertBuilder
    {

    }



    /**
     * @return InsertBuilder[]
    */
    private function getInsertQuery(): array
    {
        $insertions = [];

        if (! empty($this->builder['inserts'])) {
            foreach ($this->builder['inserts'] as $table => $attributes) {
                $qb = new InsertBuilder($this->em->getConnection());
                $qb->attributes($attributes)
                   ->table($table);
                $insertions[] = $qb;
            }
        }

        return $insertions;
    }




    /**
     * @return UpdateBuilder[]
    */
    private function getUpdateQueries(): array
    {
         $updates = [];

    }


    public function executeInsertQuery(): int
    {
          if (! empty($this->builder['inserts'])) {
               foreach ($this->builder['inserts'] as $table => $attributes) {
                    $qb = new InsertBuilder($this->em->getConnection());

               }
          }
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
    private function getParameters(): array
    {
        return $this->builder['parameters'];
    }





    /**
     * @return array
    */
    private function getQueries(): array
    {
        $queries = [];
        if ($this->builder['selects']) {
            $queries[] = $this->select()->getSQL();
        } elseif ($inserts = $this->getInsertQuery()) {
            foreach ($inserts as $insert) {
                $queries[] = $insert->getSQL();
            }
        } elseif ($updates = []) {
            $queries[] = '';
        }

        return $queries;
    }








    /**
     * @return array
    */
    private function all(): array
    {
        return $this->select()
                    ->getQuery()
                    ->fetchAll();
    }




    /**
     * @return mixed
    */
    private function one(): mixed
    {
        return $this->select()
                    ->getQuery()
                    ->fetchOne();
    }






    /**
     * @return array
    */
    private function assoc(): array
    {
        return $this->select()
                    ->getQuery()
                    ->fetchAssoc();
    }





    /**
     * @return array
    */
    private function columns(): array
    {
        return $this->select()
                    ->getQuery()
                    ->fetchColumns();
    }





    /**
     * @return ConnectionInterface
    */
    private function getConnection(): ConnectionInterface
    {
         return $this->em->getConnection();
    }
}