<?php
namespace App\Http\Client;

use App\Http\RequestInterface;
use App\Http\ResponseInterface;

interface ClientInterface
{

      /**
       * @param RequestInterface $request
       *
       * @return ResponseInterface
      */
      public function sendRequest(RequestInterface $request): ResponseInterface;
}