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
     public function getResult(): mixed;





     /**
      * @return mixed
     */
     public function getOneOrNullResult(): mixed;






     /**
      * @return array
     */
     public function getArrayResult(): array;






     /**
      * @return array
     */
     public function getArrayColumns(): array;






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