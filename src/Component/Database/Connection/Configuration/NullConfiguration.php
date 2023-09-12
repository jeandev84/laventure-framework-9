<?php
namespace Laventure\Component\Database\Connection\Configuration;

class NullConfiguration implements ConfigurationInterface
{

    /**
     * @inheritDoc
    */
    public function driver(): string
    {
        return '';
    }



    /**
     * @inheritDoc
    */
    public function host(): string
    {
        return '';
    }




    /**
     * @inheritDoc
    */
    public function username(): string
    {
         return '';
    }



    /**
     * @inheritDoc
    */
    public function password(): string
    {
         return '';
    }




    /**
     * @inheritDoc
    */
    public function port(): string
    {
         return '';
    }






    /**
     * @inheritDoc
    */
    public function database(): string
    {
         return '';
    }






    /**
     * @inheritDoc
    */
    public function charset(): string
    {
         return '';
    }







    /**
     * @inheritDoc
    */
    public function collation(): string
    {
         return '';
    }





    /**
     * @inheritDoc
    */
    public function prefix(): string
    {
         return '';
    }







    /**
     * @inheritDoc
    */
    public function engine(): string
    {
        return '';
    }





    /**
     * @inheritDoc
    */
    public function merge(array $params): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function get(string $name, $default = null): mixed
    {
         return null;
    }





    /**
     * @inheritDoc
    */
    public function has(string $name): bool
    {
         return false;
    }






    /**
     * @inheritDoc
    */
    public function isEmpty(): bool
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return [];
    }





    /**
     * @inheritDoc
    */
    public function remove(string $name): bool
    {
         return false;
    }






    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
         return false;
    }






    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
         return null;
    }






    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {

    }






    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {

    }
}