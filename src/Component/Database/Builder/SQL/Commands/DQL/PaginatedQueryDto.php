<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;

class PaginatedQueryDto implements \ArrayAccess
{


    /**
     * @var int
    */
    protected int $countItems;





    /**
     * @param array $items
     *
     * @param int $page
     *
     * @param int $totalPages
    */
    public function __construct(protected array $items, protected int $page, protected int $totalPages)
    {
    }




    /**
     * @param int $countItems
     *
     * @return $this
    */
    public function setCountItems(int $countItems): static
    {
         $this->countItems = $countItems;

         return $this;
    }






    /**
     * @return int
    */
    public function countItems(): int
    {
        return $this->countItems;
    }




    /**
     * @return object[]
    */
    public function getItems(): array
    {
        return $this->items;
    }





    /**
     * @return int
    */
    public function getCurrentPage(): int
    {
        return $this->page;
    }





    /**
     * @return int
    */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }





    /**
     * @return array
    */
    public function toArray(): array
    {
        return get_object_vars($this);
    }




    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
         return property_exists($this, $offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
         if (! $this->offsetExists($offset)) {
              return null;
         }

         return $this->$offset;
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! $this->offsetExists($offset)) {
            throw new \RuntimeException("property $offset not exists.");
        }

        $this->$offset = $value;
    }




    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
         if (! $this->offsetExists($offset)) {
            throw new \RuntimeException("property $offset not exists.");
         }

         unset($this->$offset);
    }
}