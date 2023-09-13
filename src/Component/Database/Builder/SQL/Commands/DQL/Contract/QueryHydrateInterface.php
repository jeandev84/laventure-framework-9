<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract;


/**
 * @QueryHydrateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract
*/
interface QueryHydrateInterface
{

     /**
      * @return mixed
     */
     public function fetchAll(): mixed;





     /**
      * @return mixed
     */
     public function fetchOne(): mixed;






     /**
      * @return array
     */
     public function fetchAssoc(): array;






     /**
      * @return array
     */
     public function fetchColumns(): array;






     /**
      * @param int $index
      *
      * @return mixed
     */
     public function getColumn(int $index = 0): mixed;








     /**
      * @return int
     */
     public function count(): int;
}