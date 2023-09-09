<?php
namespace Laventure\Component\Templating\Renderer;


use Laventure\Component\Templating\Template\Engine\TemplateEngine;
use Laventure\Component\Templating\Template\Template;



/**
 * @Renderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Renderer
*/
class Renderer implements RendererInterface
{


      /**
       * @var TemplateEngine
      */
      protected TemplateEngine $engine;




      /**
       * Globals parameters
       *
       * @var array
      */
      protected array $data = [];





      /**
       * @param TemplateEngine $engine
      */
      public function __construct(TemplateEngine $engine)
      {
           $this->engine = $engine;
      }






      /**
       * @param string $path
       *
       * @return $this
      */
      public function resourcePath(string $path): static
      {
          $this->engine->resourcePath($path);

          return $this;
      }







      /**
       * @param array $data
       *
       * @return $this
      */
      public function setGlobals(array $data): static
      {
          $this->data = array_merge($this->data, $data);

          return $this;
      }





      /**
       * @inheritDoc
      */
      public function render(string $path, array $data = []): string
      {
           return $this->engine->compile($this->createTemplate($path, $data));
      }







      /**
       * @param string $path
       *
       * @param array $data
       *
       * @return Template
      */
      private function createTemplate(string $path, array $data = []): Template
      {
            return $this->engine->createTemplate($path, array_merge($this->data, $data));
      }
}