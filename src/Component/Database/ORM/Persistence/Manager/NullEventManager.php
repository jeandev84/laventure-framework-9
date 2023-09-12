<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager;

class NullEventManager implements EventManagerInterface
{

    /**
     * @inheritDoc
    */
    public function subscribePersistEvents(): mixed
    {
         return $this;
    }



    /**
     * @inheritDoc
    */
    public function subscribeRemoveEvents(): mixed
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function dispatchEvent(object $event): object
    {
         return $event;
    }
}