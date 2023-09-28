<?php
namespace Laventure\Component\Database\Manager;


use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * @DatabaseManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Manager
 */
interface DatabaseManagerInterface
{


    /**
     * Open connection by given driver name
     *
     * @param string $name
     *
     * @param array $config
     *
     * @return void
    */
    public function open(string $name, array $config): void;









    /**
     * Returns all configuration
     *
     * @return ConfigurationInterface
    */
    public function config(): ConfigurationInterface;








    /**
     * Returns all connections
     *
     * @return ConnectionInterface[]
    */
    public function getConnections(): array;









    /**
     * @param string $name
     *
     * @return ConnectionInterface
    */
    public function connection(string $name = ''): ConnectionInterface;









    /**
     * Determine if the given connection name closed.
     *
     * @param string $name
     *
     * @return bool
    */
    public function connected(string $name): bool;










    /**
     * Close manager
     *
     * @return void
    */
    public function close(): void;
}