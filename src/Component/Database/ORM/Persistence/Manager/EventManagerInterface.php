<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager;


/**
 * @EventManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Manager
*/
interface EventManagerInterface
{


      /**
       * @return mixed
      */
      public function subscribePersistEvents(): mixed;





      /**
       * @return mixed
      */
      public function subscribeRemoveEvents(): mixed;





      /**
       * @param object $event
       *
       * @return object
      */
      public function dispatchEvent(object $event): object;

}