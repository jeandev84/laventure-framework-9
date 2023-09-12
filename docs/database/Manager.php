<?php

use App\RepositoryFactory;
use Laventure\Component\Database\Manager;
use Laventure\Component\Database\ORM\Persistence\Configurator;
use Laventure\Component\Database\ORM\Persistence\EntityManager;
use Laventure\Component\Database\ORM\Persistence\Manager\EventManager;
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadataFactory;

require_once __DIR__.'/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);
$config     = $filesystem->load('config/database.php');
$manager    = new Manager($config);
$connection = $manager->connection();
$definition = new Configurator();
$definition->setConnection($connection)
    ->setEventManager(new EventManager())
    ->setMetadataFactory(new ClassMetadataFactory())
    ->setRepositoryFactory(new RepositoryFactory());

$manager->setManager(new EntityManager($definition));
$em = $manager->getManager();


/*
$passwordEncoder = new \Laventure\Component\Security\Encoder\Password\PasswordEncoder();
$hashPassword = $passwordEncoder->encodePassword('123');
$user = new \App\Entity\User('jeanyao@ymail.com', $hashPassword);

$collection = new \App\Entity\ProductCollection();
foreach ($collection->all() as $product) {
    $em->persist($product);
}

$user = $em->find(\App\Entity\User::class, 1);

#dd($user);
#dd($em->getUnitOfWork());
*/