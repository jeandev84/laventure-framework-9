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
        * @return static
       */
       public function connectFirst(ConfigurationInterface $config): static;






       /**
        * @param ConfigurationInterface $config
        *
        * @return static
       */
       public function connectLast(ConfigurationInterface $config): static;
}