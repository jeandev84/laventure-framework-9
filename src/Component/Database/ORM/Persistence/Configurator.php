<?php
namespace Laventure\Component\Database\ORM\Persistence;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\NullConnection;
use Laventure\Component\Database\ORM\Persistence\Manager\EventManager;
use Laventure\Component\Database\ORM\Persistence\Manager\EventManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\NullEventManager;
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\NullClassMetadataFactory;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepositoryFactory;
use Laventure\Component\Database\ORM\Persistence\Repository\NullRepositoryFactory;


/**
 * @Configurator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence
*/
class Configurator
{


        /**
         * @var ConnectionInterface
        */
        protected ConnectionInterface $connection;


        /**
         * @var ClassMetadataFactoryInterface
        */
        protected ClassMetadataFactoryInterface $metadataFactory;




        protected EntityRepositoryFactory $repositoryFactory;



        /**
         * @var EventManagerInterface
        */
        protected EventManagerInterface $eventManager;






        public function __construct()
        {
            $this->setConnection(new NullConnection())
                 ->setRepositoryFactory(new NullRepositoryFactory())
                 ->setMetadataFactory(new NullClassMetadataFactory())
                 ->setEventManager(new NullEventManager());
        }






        /**
          * @param ConnectionInterface $connection
          * @return Configurator
        */
        public function setConnection(ConnectionInterface $connection): static
        {
             $this->connection = $connection;

             return $this;
        }







        /**
         * @param EntityRepositoryFactory $repositoryFactory
         *
         * @return Configurator
        */
        public function setRepositoryFactory(EntityRepositoryFactory $repositoryFactory): static
        {
             $this->repositoryFactory = $repositoryFactory;

             return $this;
        }






        /**
         * @param ClassMetadataFactoryInterface $metadataFactory
         *
         * @return $this
        */
        public function setMetadataFactory(ClassMetadataFactoryInterface $metadataFactory): static
        {
             $this->metadataFactory = $metadataFactory;

             return $this;
        }





        /**
         * @param EventManagerInterface $eventManager
         *
         * @return static
        */
        public function setEventManager(EventManagerInterface $eventManager): static
        {
             $this->eventManager = $eventManager;

             return $this;
        }





        /**
         * @return ConnectionInterface
        */
        public function getConnection(): ConnectionInterface
        {
             return $this->connection;
        }







        /**
         * @return EntityRepositoryFactory
        */
        public function getRepositoryFactory(): EntityRepositoryFactory
        {
             return $this->repositoryFactory;
        }






        /**
         * @return ClassMetadataFactoryInterface
        */
        public function getMetadataFactory(): ClassMetadataFactoryInterface
        {
             return $this->metadataFactory;
        }






        /**
         * @return EventManagerInterface
        */
        public function getEventManager(): EventManagerInterface
        {
            return $this->eventManager;
        }
}