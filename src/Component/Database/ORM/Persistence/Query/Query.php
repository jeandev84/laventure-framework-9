<?php
namespace Laventure\Component\Database\ORM\Persistence\Query;

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
     * @var EntityManager
    */
    protected EntityManager $em;




    /**
     * @param EntityManager $em
    */
    public function __construct(EntityManager $em)
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
}