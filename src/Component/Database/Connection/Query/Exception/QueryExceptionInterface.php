<?php
namespace Laventure\Component\Database\Connection\Query;


/**
 * @inheritdoc
*/
interface QueryExceptionInterface extends \Throwable
{
      /**
       * @return string
      */
      public function getSQl(): string;



      /**
       * @return array
      */
      public function getParameters(): array;




      /**
       * @return string
      */
      public function __toString(): string;
}