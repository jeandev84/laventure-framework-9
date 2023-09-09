<?php
namespace Laventure\Component\Routing\Group;


use Closure;
use Laventure\Component\Routing\Router;

/**
 * @RouteGroupInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Group
*/
interface RouteGroupInterface
{


    /**
     * @param array $attributes
     *
     * @param RouteGroupInvoker $invoker
     *
     * @return mixed
    */
    public function group(array $attributes, RouteGroupInvoker $invoker): mixed;





    /**
     * Rewind attributes
     *
     * @return void
    */
    public function rewind(): void;






    /**
     * Returns route prefixes
     *
     * @return array
    */
    public function getPrefixes(): array;
}