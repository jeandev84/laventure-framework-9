<?php
namespace Laventure\Component\Database\ORM\Persistence;


use Laventure\Component\Database\ORM\Collection\ObjectStorage;
use Laventure\Component\Database\ORM\Persistence\Manager\EventManager;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\OnClearEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\OnFlushEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PreFlushEvent;
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\UnitOfWork\UnitOfWorkInterface;


/**
 * @inheritdoc
*/
class UnitOfWork implements UnitOfWorkInterface
{


    /**
     * @var Persistence
    */
    protected Persistence $persistence;




    /**
     * @var EntityManager
    */
    protected EntityManager $em;




    /**
     * @var ObjectStorage
    */
    protected ObjectStorage $storage;





    /**
     * @var DataMapper
    */
    protected DataMapper $dataMapper;




    /**
     * @var EventManager
    */
    protected EventManager $eventManager;




    /**
     * @var array
    */
    protected array $detached = [];




    /**
     * @param EntityManager $em
    */
    public function __construct(EntityManager $em)
    {
         $this->em           = $em;
         $this->eventManager = $em->getEventManager();
         $this->dataMapper   = new DataMapper($this->em);
         $this->storage      = new ObjectStorage();
    }








    /**
     * @param string|object $context
     *
     * @return Persistence
    */
    public function getPersistence(string|object $context): Persistence
    {
         return new Persistence($this->em, $context);
    }






    /**
     * @inheritDoc
    */
    public function persist(object $object): void
    {
        $this->addPersistState($object);
    }






    /**
     * @inheritDoc
    */
    public function remove(object $object): void
    {
         $this->addRemovedState($object);
    }







    /**
     * @inheritDoc
    */
    public function find(int $id): ?object
    {
        return $this->dataMapper->find($id);
    }





    /**
     * @inheritDoc
    */
    public function refresh(object $object): void
    {

    }




    /**
     * @inheritDoc
    */
    public function attach(object $object): void
    {
        $this->storage->attach($object);
    }




    /**
     * @inheritDoc
    */
    public function contains(object $object): bool
    {
        return $this->storage->contains($object);
    }







    /**
     * @inheritDoc
    */
    public function detach(object $object): void
    {
        $this->storage->detach($object);
    }





    /**
     * @inheritDoc
    */
    public function merge(object $object): void
    {
         $this->attach($object);
    }





    /**
     * @inheritDoc
    */
    public function commit(): void
    {
         $this->em->transaction(function () {
              foreach ($this->storage as $object) {
                  $state = $this->storage->getInfo();
                  switch ($state):
                       case self::STATE_MANAGED:
                       case self::STATE_NEW:
                          $this->dataMapper->save($object);
                       break;
                       case self::STATE_REMOVED;
                          $this->dataMapper->delete($object);
                       break;
                  endswitch;
              }
              $this->clear();
         });

    }






    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->eventManager->dispatchEvent(new OnClearEvent($this->em));

        $this->storage->clear();
    }





    /**
     * @param $object
     *
     * @return ClassMetadata
    */
    public function metadata($object): ClassMetadata
    {
        return $this->em->getClassMetadata($object);
    }






    /**
     * @inheritDoc
    */
    public function addPersistState(object $object): void
    {
        try {
            $this->eventManager->subscribePersistEvents();

            if ($this->metadata($object)->map()->isNew()) {
                $this->storage->attach($object, self::STATE_NEW);
            } else {
                $this->storage->attach($object, self::STATE_MANAGED);
            }
        } catch (\Exception $e) {
             $this->em->close();
             dd($e->getMessage());
             throw new \RuntimeException($e->getMessage(), $e->getCode());
        }
    }






    /**
     * @inheritDoc
    */
    public function addRemovedState(object $object): void
    {
         $this->eventManager->subscribeRemoveEvents();
         $this->storage->attach($object, self::STATE_REMOVED);
    }








    /**
     * @inheritDoc
    */
    public function addDetachedState(object $object): void
    {
         $this->storage->detach($object);
         $this->detached[self::STATE_DETACHED][] = $object;
    }





    /**
     * @return EventManager
    */
    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }





    /**
     * @return ObjectStorage
    */
    public function getStorage(): ObjectStorage
    {
        return $this->storage;
    }
}