<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence;


/**
 * @PersistenceObjectResultInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DQL\Persistence
 */
interface PersistenceResultInterface
{

       /**
        * Save objects collection result and returns them
        *
        * @param object[] $objects
        *
        * @return object[]
       */
       public function saveResult(array $objects): mixed;


       


       
       
       /**
        * Save and returns saved object
        *
        * @param object $object
        * 
        * 
        * @return object|null
       */
       public function saveOneResult(object $object): mixed;
}