<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;


/**
 * @InsertBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DML\Contract
*/
interface InsertBuilderInterface
{

       /**
        * @param array $attributes
        *
        * @return $this
       */
       public function insert(array $attributes): static;






       /**
        * @param string $name
        *
        * @param $value
        *
        * @return $this
       */
       public function set(string $name, $value): static;







       /**
        * Returns last inserted ID
        *
        * @return int
       */
       public function execute(): int;
}