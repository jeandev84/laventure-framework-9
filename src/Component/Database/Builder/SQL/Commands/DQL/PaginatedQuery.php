<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;


use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\PaginatedQueryInterface;


/**
 * @inheritdoc
*/
class PaginatedQuery implements PaginatedQueryInterface
{


        /**
         * @param SelectBuilder $select
        */
       public function __construct(protected SelectBuilder $select)
       {
       }





       /**
        * @inheritdoc
       */
       public function getTotalRecords(): array
       {
            return $this->select->getQuery()->getResult();
       }






       /**
        * @inheritdoc
       */
       public function paginate(int $page, int $limit = 5): PaginatedQueryDto
       {
             $offset = $limit * abs($page - 1);
             $result = $this->select->setFirstResult($offset)
                                    ->setMaxResults($limit)
                                    ->fetch();

             $items  = $result->all();

             $dto = new PaginatedQueryDto($items, $page, $limit);
             $dto->setCountItems($result->count());
             return $dto;
       }
}