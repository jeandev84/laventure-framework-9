<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Closure;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\DriverConnectionInterface;
use Laventure\Component\Database\Connection\Exception\DriverConnectionException;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use PDO;


/**
 * @inheritdoc
*/
abstract class DriverConnection extends PdoConnection implements DriverConnectionInterface
{


    /**
     * @var ConfigurationInterface|null
     */
    protected ?ConfigurationInterface $config;



    /**
     * @inheritDoc
     */
    public function connect(ConfigurationInterface $config): void
    {
        $this->setConnection($config);
    }






    /**
     * @param ConfigurationInterface $config
     *
     * @return void
     */
    public function setConnection(ConfigurationInterface $config): void
    {
        if (! $this->enabledDriver($driver = $config->driver())) {
            $this->createDriverException("Unavailable PDO driver '$driver'");
        }

        $this->config = $this->resolveConfiguration($config);

        $this->connectBegin($this->config);

        if (in_array($this->config['database'], $this->getDatabases())) {
            $this->connectEnd($this->config);
        }
    }






    /**
     * @inheritDoc
     */
    public function getConnection(): ?PDO
    {
        return $this->pdo;
    }






    /**
     * @inheritDoc
     */
    public function config(): ConfigurationInterface
    {
        return $this->config;
    }







    /**
     * @inheritDoc
     */
    public function hasDatabase(): bool
    {
        return in_array($this->config->database(), $this->getDatabases());
    }





    /**
     * @inheritDoc
     */
    public function reconnect(): void
    {
        $this->connect($this->config);
    }





    /**
     * @inheritdoc
    */
    public function connectFirst(ConfigurationInterface $config): void
    {
        $this->open($config['dsn'], $config->username(), $config->password(), $config->get('options', []));
    }







    /**
     * @inheritdoc
    */
    public function connectLast(ConfigurationInterface $config): void
    {
        $config['dsn'] .= ";dbname={$config->database()};";

        $this->open($config['dsn'], $config->username(), $config->password(), $config->get('options', []));
    }







    /**
     * @inheritDoc
    */
    public function getDatabase(): string
    {
        return $this->config->database();
    }







    /**
     * @inheritdoc
     */
    public function purge(): bool
    {
        $this->disconnect();
        $this->config = null;
        return true;
    }







    /**
     * @inheritDoc
    */
    public function hasTable(string $name): bool
    {
        return in_array($name, $this->getTables());
    }






    /**
     * @param string $driver
     *
     * @param array $params
     *
     * @return string
    */
    protected function buildPdoDsn(string $driver, array $params): string
    {
        return sprintf('%s:%s',  $driver, http_build_query($params,'', ';'));
    }



    /**
     * @param string $message
     *
     * @return void
    */
    protected function createDriverException(string $message): void
    {
        (function () use ($message) {
            throw new DriverConnectionException($message);
        })();
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return ConfigurationInterface
    */
    abstract protected function resolveConfiguration(ConfigurationInterface $config): ConfigurationInterface;
}