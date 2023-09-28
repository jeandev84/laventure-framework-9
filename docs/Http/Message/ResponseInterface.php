<?php
namespace App\Http;

interface ResponseInterface
{

      /**
       * @return mixed
      */
      public function getStatusCode();


      /**
       * @return mixed
      */
      public function getHeaders();

      /**
       * @return mixed
      */
      public function getContent();
}