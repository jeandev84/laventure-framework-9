<?php
namespace Laventure\Component\Database\Connection;

use Closure;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Query\NullQuery;
use Laventure\Component\Database\Connection\Query\QueryInterface;

class NullConnection implements ConnectionInterface
{

    /**
     * @inheritDoc
    */
    public function getName(): string
    {
         return '';
    }




    /**
     * @inheritDoc
    */
    public function connect(ConfigurationInterface $config): void
    {

    }




    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
         return false;
    }






    /**
     * @inheritDoc
    */
    public function reconnect(): void
    {

    }







    /**
     * @inheritDoc
    */
    public function disconnect(): void
    {

    }





    /**
     * @inheritDoc
    */
    public function purge(): mixed
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {
        return new NullQuery();
    }




    /**
     * @inheritDoc
    */
    public function statement(string $sql, array $params = []): QueryInterface
    {
         return $this->createQuery();
    }




    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
         return false;
    }





    /**
     * @inheritDoc
    */
    public function hasActiveTransaction(): bool
    {
         return false;
    }




    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
         return false;
    }




    /**
     * @inheritDoc
    */
    public function transaction(Closure $func): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function lastInsertId($name = null): int
    {
         return false;
    }





    /**
     * @inheritDoc
    */
    public function executeQuery(string $sql): bool
    {
         return false;
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): mixed
    {
         return null;
    }





    /**
     * @inheritDoc
    */
    public function config(): ConfigurationInterface
    {

    }

    /**
     * @inheritDoc
     */
    public function getDatabase(): string
    {
        // TODO: Implement getDatabase() method.
    }

    /**
     * @inheritDoc
     */
    public function getDatabases(): array
    {
        // TODO: Implement getDatabases() method.
    }

    /**
     * @inheritDoc
     */
    public function createDatabase(): mixed
    {
        // TODO: Implement createDatabase() method.
    }

    /**
     * @inheritDoc
     */
    public function dropDatabase(): mixed
    {
        // TODO: Implement dropDatabase() method.
    }

    /**
     * @inheritDoc
     */
    public function hasDatabase(): bool
    {
        // TODO: Implement hasDatabase() method.
    }

    /**
     * @inheritDoc
     */
    public function hasTable(string $name): bool
    {
        // TODO: Implement hasTable() method.
    }

    /**
     * @inheritDoc
     */
    public function getTables(): array
    {
        // TODO: Implement getTables() method.
    }

    /**
     * @inheritDoc
     */
    public function getQueries(): array
    {
        // TODO: Implement getQueries() method.
    }
}