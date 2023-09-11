<?php
namespace  Laventure\Component\Database\Builder\SQL\Commands;

/**
 * @HasConditionBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
interface HasExpressionBuilderInterface
{
     public function expr();
}