<?php
namespace Laventure\Component\Database\ORM\Persistence;


use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Query\QueryBuilder;



/**
 * @Persistence
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence
*/
class Persistence
{


    /**
     * @var EntityManager
    */
    protected EntityManager $em;




    /**
     * @var ClassMetadata
    */
    protected ClassMetadata $metadata;






    /**
     * @param EntityManager $em
     *
     * @param $classname
    */
    public function __construct(EntityManager $em, $classname)
    {
         $this->em        = $em;
         $this->metadata  = $this->em->getClassMetadata($classname);
    }





    /**
     * @param string|null $selects
     *
     * @return SelectBuilder
    */
    public function select(string $selects = null): SelectBuilder
    {
         return $this->createQueryBuilder()
                     ->select($selects)
                     ->from($this->getTableName())
                     ->map($this->getClassname());
    }







    /**
     * @param int $id
     *
     * @return object|null|mixed
    */
    public function find(int $id): mixed
    {
        return $this->select()
                    ->criteria([$this->identifier() => $id])
                    ->getQuery()
                    ->getOneOrNullResult();
    }







    /**
     * @return array|object[]
    */
    public function findAll(): array
    {
         return $this->select()
                    ->getQuery()
                    ->getResult();
    }





    /**
     * @return int
    */
    public function insert(): int
    {
         return $this->createQueryBuilder()
                     ->insert($this->getTableName(), $this->getAttributes())
                     ->execute();
    }






    /**
     * @return int
    */
    public function update(): int
    {
         return $this->createQueryBuilder()
                     ->update($this->getTableName(), $this->getAttributes())
                     ->criteria($this->criteria())
                     ->execute();
    }







    /**
     * @return bool
    */
    public function delete(): bool
    {
        return $this->createQueryBuilder()
                    ->delete($this->getTableName())
                    ->criteria($this->criteria())
                    ->execute();
    }





    /**
     * @return ClassMetadata
    */
    public function metadata(): ClassMetadata
    {
        return $this->metadata;
    }






    /**
     * @return array
    */
    private function criteria(): array
    {
        return [$this->identifier() => $this->getIdentifierValue()];
    }





    /**
     * @return QueryBuilder
    */
    public function createQueryBuilder(): QueryBuilder
    {
        return $this->em->createQueryBuilder();
    }






    /**
     * @return string
    */
    public function identifier(): string
    {
        return $this->metadata->getIdentifier();
    }






    /**
     * @return string
    */
    public function getClassname(): string
    {
        return $this->metadata->getClassname();
    }





    /**
     * @return string
    */
    public function getTableName(): string
    {
        return $this->metadata->getTableName();
    }






    /**
     * @return array
    */
    public function getAttributes(): array
    {
        return $this->metadata->map()->getAttributes();
    }






    /**
     * @return int|null
    */
    public function getIdentifierValue(): ?int
    {
        return $this->metadata->map()->getIdentifierValue();
    }
}