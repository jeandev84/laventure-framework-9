<?php
namespace Laventure\Component\Database\ORM\Pagination;

use Laventure\Component\Database\Builder\SQL\Commands\DQL\PaginatedQuery;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;


/**
 * @Paginator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Pagination
*/
class Paginator
{


       /**
        * @var PaginatedQuery
       */
       protected PaginatedQuery $paginatedQuery;




      /**
       * @param SelectBuilder $select
      */
      public function __construct(SelectBuilder $select)
      {
            $this->paginatedQuery = $select->getPaginatedQuery();
      }




      /**
       * @param int $page
       *
       * @param int $limit
       *
       * @return array
      */
      public function paginate(int $page, int $limit): array
      {
            return [];
      }
}