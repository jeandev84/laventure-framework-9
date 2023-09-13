<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;

use Laventure\Component\Database\Builder\SQL\Commands\BuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\JoinType;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\NullBuilder;
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
     * @param string|null $hydrate
     *
     * @return mixed
    */
    public function execute(string $hydrate = null): mixed
    {
           switch ($hydrate):
               case self::HYDRATE_ALL:
                   if($objects = $this->fetchAll()) {
                       $this->persistence($objects);
                   }
                   return $objects;
               case self::HYDRATE_ONE:
                   $object = $this->fetchOne();
                   $this->persistence([$object]);
                   return $object;
               case self::HYDRATE_ARRAY:
                   return $this->fetchAssoc();
               case self::HYDRATE_COLUMNS:
                   return $this->fetchColumns();
               default:
                 return $this->executeQuery();
           endswitch;
    }





    /**
     * @return string
    */
    public function getSQL(): string
    {
         foreach ($this->getQueries() as $key =>  $sql) {
              if (! empty($this->builder[$key])) {
                   return $sql;
              }
         }

         return '';
    }







    /**
     * @return SelectBuilder
    */
    private function select(): SelectBuilder
    {
        $qb = new SelectBuilder($this->getConnection());
        return   $qb->addSelect(join(', ', $this->builder['selects']))
                    ->addFrom($this->builder['from'])
                    ->addJoins($this->builder['joins'], JoinType::JOIN)
                    ->addJoins($this->builder['leftJoin'], JoinType::LEFT_JOIN)
                    ->addJoins($this->builder['rightJoin'], JoinType::RIGHT_JOIN)
                    ->addJoins($this->builder['innerJoin'], JoinType::INNER_JOIN)
                    ->addJoins($this->builder['fullJoin'], JoinType::FULL_JOIN)
                    ->addGroupBy($this->builder['groupBy'])
                    ->addHaving($this->builder['having'])
                    ->addOrderBy($this->builder['orderBy'])
                    ->addConditions(['AND' => $this->andWheres(), 'OR' => $this->orWheres()])
                    ->setMaxResults($this->builder['limit'])
                    ->setFirstResult($this->builder['offset'])
                    ->setParameters($this->getParameters());
    }






    /**
     * @return BuilderInterface
    */
    private function insert(): BuilderInterface
    {
         if (empty($this->builder['inserts'])) {
              return new NullBuilder();
         }

         [$table, $attributes] = $this->builder['inserts'];
         $qb = new InsertBuilder($this->getConnection());
         return $qb->attributes($attributes)->table($table);
    }








    /**
     * @return UpdateBuilder
    */
    private function update(): 
    {
        if (empty($this->builder['updates'])) {
             return new NullBuilder();
        }
        [$table, $alias] = $this->builder['updates'];
        $qb = new UpdateBuilder($this->getConnection());
        return $qb->update($this->builder['set'])
                  ->table($table, $alias)
                  ->addConditions(['AND' => $this->andWheres(), 'OR' => $this->orWheres()]);
    }





    /**
     * @return DeleteBuilder
    */
    private function delete(): DeleteBuilder
    {
        [$table, $alias] = $this->builder['updates'];
        $qb = new DeleteBuilder($this->getConnection());
        return $qb->delete()
                  ->table($table, $alias)
                  ->addConditions(['AND' => $this->andWheres(), 'OR' => $this->orWheres()]);
    }





    /**
     * @return mixed
    */
    private function executeQuery(): mixed
    {
        /** @var BuilderInterface[] $queries */
        $queries = [
            'inserts' => $this->insert(),
            'updates' => $this->update(),
            'deletes' => $this->delete(),
        ];

        foreach ($queries as $index => $builder) {
            if (! empty($this->builder[$index])) {
                 return $builder->execute();
            }
        }

        return false;
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
    private function fetchAll(): array
    {
        return $this->select()
                    ->getQuery()
                    ->getResult();
    }




    /**
     * @return mixed
    */
    private function fetchOne(): mixed
    {
        return $this->select()
                    ->getQuery()
                    ->getOneOrNullResult();
    }






    /**
     * @return array
    */
    private function fetchAssoc(): array
    {
        return $this->select()
                    ->getQuery()
                    ->getArrayResult();
    }





    /**
     * @return array
    */
    private function fetchColumns(): array
    {
        return $this->select()
                    ->getQuery()
                    ->getArrayColumns();
    }





    /**
     * @return ConnectionInterface
    */
    private function getConnection(): ConnectionInterface
    {
         return $this->em->getConnection();
    }






    /**
     * @param array $objects
     *
     * @return void
    */
    private function persistence(array $objects): void
    {
         foreach ($objects as $object) {
              if (! is_object($object)) {
                   continue;
              }
              $this->em->persist($object);
         }
    }




    private function getQueries(): array
    {
        return [
            'selects' => $this->select()->getSQL(),
            'inserts' => $this->insert()->getSQL(),
            'updates' => $this->update()->getSQL(),
            'deletes' => $this->delete()->getSQL(),
        ];
    }

}