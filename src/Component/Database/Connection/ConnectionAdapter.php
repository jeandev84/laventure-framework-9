<?php
namespace Laventure\Component\Database\Connection;

use Closure;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;


/**
 * @ConnectionAdapter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection
*/
class ConnectionAdapter
{


    /**
     * @var DriverConnectionInterface
    */
    protected DriverConnectionInterface $driver;





    /**
     * @param DriverConnectionInterface $driver
    */
    public function __construct(DriverConnectionInterface $driver)
    {
        $this->driver = $driver;
    }





    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->driver->getName();
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    public function connect(ConfigurationInterface $config): void
    {
        $this->driver->connect($config);
    }




    /**
     * @return bool
    */
    public function connected(): bool
    {
        return $this->driver->connected();
    }





    /**
     * @return void
    */
    public function reconnect(): void
    {
        $this->driver->reconnect();
    }






    /**
     * @return void
    */
    public function disconnect(): void
    {
        $this->driver->disconnect();
    }







    /**
     * @return void
    */
    public function purge(): void
    {
        $this->driver->purge();
    }





    /**
     * @return bool
    */
    public function disconnected(): bool
    {
        return $this->driver->disconnected();
    }





    /**
     * @return QueryInterface
    */
    public function createQuery(): QueryInterface
    {
        return $this->driver->createQuery();
    }






    /**
     * @param string $sql
     *
     * @param array $params
     *
     * @return QueryInterface
    */
    public function statement(string $sql, array $params = []): QueryInterface
    {
        return $this->driver->statement($sql, $params);
    }






    /**
     * @return bool
    */
    public function beginTransaction(): bool
    {
        return $this->driver->beginTransaction();
    }





    /**
     * @return bool
    */
    public function hasActiveTransaction(): bool
    {
        return $this->driver->hasActiveTransaction();
    }






    /**
     * @return bool
    */
    public function commit(): bool
    {
        return $this->driver->commit();
    }






    /**
     * @return bool
    */
    public function rollback(): bool
    {
        return $this->driver->rollback();
    }






    /**
     * @param Closure $func
     *
     * @return void
    */
    public function transaction(Closure $func): void
    {
        $this->driver->transaction($func);
    }







    /**
     * @param $name
     *
     * @return int
    */
    public function lastInsertId($name = null): int
    {
        return $this->driver->lastInsertId($name);
    }






    /**
     * @param string $sql
     *
     * @return bool
    */
    public function executeQuery(string $sql): bool
    {
        return $this->driver->exec($sql);
    }






    /**
     * @return mixed
    */
    public function getConnection(): mixed
    {
        return $this->driver->getConnection();
    }





    /**
     * @return ConfigurationInterface
    */
    public function config(): ConfigurationInterface
    {
        return $this->driver->config();
    }






    /**
     * @return string
    */
    public function getDatabase(): string
    {
        return $this->driver->getDatabase();
    }






    /**
     * @return array
    */
    public function getDatabases(): array
    {
        return $this->driver->getDatabases();
    }





    /**
     * @return mixed
    */
    public function createDatabase(): mixed
    {
        return $this->driver->createDatabase();
    }





    /**
     * @return mixed
    */
    public function dropDatabase(): mixed
    {
        return $this->driver->dropDatabase();
    }






    /**
     * @return bool
    */
    public function hasDatabase(): bool
    {
        return $this->driver->hasDatabase();
    }





    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasTable(string $name): bool
    {
        return $this->driver->hasTable($name);
    }





    /**
     * @return array
    */
    public function getTables(): array
    {
        return $this->driver->getTables();
    }





    /**
     * @return QueryInterface[]
    */
    public function getQueries(): array
    {
        return $this->driver->getQueries();
    }
}