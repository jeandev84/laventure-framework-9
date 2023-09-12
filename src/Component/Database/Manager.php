<?php
namespace Laventure\Component\Database;

use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnectionInterface;
use Laventure\Component\Database\Manager\DatabaseManager;
use Laventure\Component\Database\ORM\Persistence\EntityManager;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepository;


/**
 * @inheritdoc
*/
class Manager extends DatabaseManager
{


    /**
     * @var Configuration
     */
    protected Configuration $config;





    /**
     * @var EntityManager|null
    */
    protected ?EntityManager $em = null;





    /**
     * @var static
    */
    protected static $instance;






    /**
     * @param array $config
    */
    public function __construct(array $config)
    {
        if (! self::$instance) {
            $this->config = new Configuration($config);
            $connection   = $this->config->required('connection');
            $credentials  = $this->config->required('connections');
            $this->open($connection, $credentials);
            self::$instance = $this;
        }
    }




    /**
     * @return static
    */
    public static function capsule(): static
    {
        if (! self::$instance) {
            throw new \RuntimeException("No connection to database detected from:". get_called_class());
        }

        return self::$instance;
    }





    /**
     * @param EntityManager $em
     *
     * @return $this
    */
    public function setManager(EntityManager $em): static
    {
        $this->em = $em;

        return $this;
    }





    /**
     * @return EntityManager
    */
    public function getManager(): EntityManager
    {
        if (! $this->em) {
            $this->abortIf("no entity manager detected.");
        }

        return $this->em;
    }





    /**
     * @param string $classname
     *
     * @return EntityRepository
    */
    public function getRepository(string $classname): EntityRepository
    {
        return $this->getManager()->getRepository($classname);
    }







    /**
     * @inheritDoc
    */
    public function config(): Configuration
    {
        return $this->config;
    }









    /**
     * @inheritdoc
    */
    public function close(): void
    {
        parent::close();
        $this->config->removeAll();
    }
}