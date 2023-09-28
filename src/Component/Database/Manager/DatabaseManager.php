<?php
namespace Laventure\Component\Database\Manager;

use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * @inheritdoc
*/
class DatabaseManager implements DatabaseManagerInterface
{



    /**
     * @var string|null
    */
    protected ?string $connection;




    /**
     * @var ConnectionInterface[]
    */
    protected array $connections = [];




    /**
     * @var array
    */
    protected array $config = [];





    /**
     * @var ConnectionInterface[]
    */
    protected array $connected = [];





    /**
     * @inheritDoc
    */
    public function open(string $name, array $config): void
    {
         $this->setCurrentConnection($name)
              ->setConfigurations($config);
    }








    /**
     * @param string $connection
     *
     * @return $this
    */
    public function setCurrentConnection(string $connection): static
    {
         $this->connection = $connection;

         return $this;
    }






    /**
     * Set configuration from arrays
     *
     * @param array $credentials
     *
     * @return $this
    */
    public function setConfigurations(array $credentials): static
    {
        foreach ($credentials as $name => $params) {
            $this->config[$name] = $params;
        }

        return $this;
    }







    /**
     * @param string $name
     *
     * @return array
    */
    public function configuration(string $name): array
    {
        if (empty($this->config[$name])) {
            $this->abortIf("empty credentials for connection '$name'");
        }

        return $this->config[$name];
    }








    /**
     * @param ConnectionInterface $connection
     *
     * @return $this
     */
    public function setConnection(ConnectionInterface $connection): static
    {
        $this->connections[$connection->getName()] = $connection;

        return $this;
    }







    /**
     * Determine if exists connection by given name
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasConnection(string $name): bool
    {
        return isset($this->connections[$name]);
    }







    /**
     * @param array $connections
     *
     * @return $this
     */
    public function setConnections(array $connections): static
    {
        foreach ($connections as $connection) {
            $this->setConnection($connection);
        }

        return $this;
    }







    /**
     * @param string|null $name
     *
     * @return ConnectionInterface
    */
    public function connection(string $name = null): ConnectionInterface
    {
        $name   = $name ?: $this->connection;
        $config = $this->configuration($name);

        if (! $this->hasConnection($name)) {
            $this->abortIf("unavailable connection named '$name'");
        }

        return $this->connect($name, $config);
    }









    /**
     * @inheritDoc
    */
    public function connected(string $name): bool
    {
         return isset($this->connected[$name]);
    }







    /**
     * @inheritDoc
    */
    public function config(): ConfigurationInterface
    {
        return new Configuration($this->config);
    }







    /**
     * @inheritDoc
    */
    public function getConnections(): array
    {
        return $this->connections;
    }






    /**
     * @return array
    */
    public function getConfigurations(): array
    {
        return $this->config;
    }






    /**
     * @inheritDoc
    */
    public function close(): void
    {
        $this->connection  = null;
        $this->config      = [];
        $this->connections = [];
        $this->connected   = [];
    }





    /**
     * @param string $message
     * @param int $code
     * @return void
    */
    public function abortIf(string $message, int $code = 500): void
    {
        (function () use ($message, $code) {
            throw new DatabaseManagerException($message, $code);
        })();
    }


    

    /**
     * @param string $name
     *
     * @param array $config
     *
     * @return ConnectionInterface
    */
    private function connect(string $name, array $config): ConnectionInterface
    {
        $this->connections[$name]->connect(new Configuration($config));

        if (! $this->connections[$name]->connected()) {
            $this->abortIf("no connection detected for '$name'.");
        }

        $this->setCurrentConnection($name);

        return $this->connected[$name] = $this->connections[$name];
    }
}