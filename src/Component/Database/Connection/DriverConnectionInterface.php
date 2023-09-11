<?php
namespace Laventure\Component\Database\Connection;


use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;

/**
 * @inheritdoc
*/
interface DriverConnectionInterface extends ConnectionInterface
{
    /**
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    public function connectBegin(ConfigurationInterface $config): void;





    /**
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    public function connectEnd(ConfigurationInterface $config): void;
}