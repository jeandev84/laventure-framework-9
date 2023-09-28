<?php
namespace App\Http;

use App\Http\Client\ClientInterface;

class CurlClient implements ClientInterface
{


    /**
     * @param array $options
    */
    public function __construct(array $options = [])
    {
    }





    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
          return new Response('получил ответ', 200, []);
    }
}