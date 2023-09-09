<?php
namespace Laventure\Component\Routing\Group;

use Closure;
use Laventure\Component\Routing\Router;

class RouteGroupInvoker
{

      /**
       * @var Closure
      */
      protected Closure $routes;




      /**
       * @var Router
      */
      protected Router $router;





      /**
       * @param Closure $routes
       *
       * @param Router $router
       *
      */
      public function __construct(Closure $routes, Router $router)
      {
           $this->routes = $routes;
           $this->router = $router;
      }






     /**
      * @return void
     */
     public function invoke(): void
     {
         try {
            $invoker = new \ReflectionFunction($this->routes);
            $invoker->invoke($this->router);
         } catch (\Exception $e) {
             trigger_error($e->getMessage());
         }
     }
}