<?php
namespace App\Http;

class Request implements RequestInterface
{

    protected ?string $method = 'GET';
    protected ?string  $url;


    /**
     * @param string|null $method
     *
     * @return $this
    */
    public function setMethod(?string $method): static
    {
        $this->method = $method;

        return $this;
    }






    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }






    /**
     * @param string $url
     *
     * @return $this
    */
    public function setUrl(string $url): static
    {
         $this->url = $url;

         return $this;
    }






    /**
     * @return string|null
    */
    public function getUrl(): ?string
    {
       return $this->url;
    }



    /**
     * @param string $method
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return static
    */
    public static function create(string $method, string $url, array $options = []): static
    {
         $request = new static();
         $request->setMethod($method)
                 ->setUrl($url);

         return $request;
    }
}