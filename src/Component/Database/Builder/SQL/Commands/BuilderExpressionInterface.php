<?php
namespace  Laventure\Component\Database\Builder\SQL\Commands;

use Laventure\Component\Database\Builder\SQL\Commands\Expr\Expr;

/**
 * @BuilderConditionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
interface BuilderExpressionInterface
{

     /**
      * @return Expr
     */
     public function expr(): Expr;
}