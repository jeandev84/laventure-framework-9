<?php
namespace App\Http;

use App\Http\Client\HttpClientInterface;

class HttpClient implements HttpClientInterface
{

    /**
     * @inheritDoc
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
         $client = new CurlClient($options);
         return $client->sendRequest(Request::create($method, $url));
    }





    /**
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     */
    public function get(string $url, array $options = []): ResponseInterface
    {
         return $this->request('GET', $url, $options);
    }
}