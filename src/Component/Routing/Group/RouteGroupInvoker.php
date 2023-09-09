<?php
namespace Laventure\Component\Routing\Group;

use Closure;
use Laventure\Component\Routing\Router;

class RouteGroupInvoker
{

      /**
       * @var Closure
      */
      protected $func;




      /**
       * @var Router
      */
      protected Router $router;





      /**
       * @param Closure $func
       *
       * @param Router $router
       *
      */
      public function __construct(Closure $func, Router $router)
      {
           $this->func   = $func;
           $this->router = $router;
      }






     /**
      * @return void
     */
     public function invoke(): void
     {
         try {
            $invoker = new \ReflectionFunction($this->func);
            $invoker->invoke($this->router);
         } catch (\Exception $e) {
             trigger_error($e->getMessage());
         }
     }




     public function rewind()
     {

     }
}