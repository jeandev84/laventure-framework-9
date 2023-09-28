<?php
namespace App\Http;

class Response implements ResponseInterface
{


    /**
     * @param $content
     *
     * @param int $statusCode
     *
     * @param array $headers
    */
    public function __construct(protected $content, protected int $statusCode = 200, protected array $headers = [])
    {

    }




    /**
     * @inheritDoc
    */
    public function getStatusCode()
    {
         return $this->statusCode;
    }





    /**
     * @inheritDoc
    */
    public function getHeaders()
    {
         return $this->headers;
    }






    /**
     * @inheritDoc
    */
    public function getContent()
    {
        return $this->content;
    }
}