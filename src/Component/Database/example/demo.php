<?php

use App\RepositoryFactory;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Hydrate;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;
use Laventure\Component\Database\Manager;
use Laventure\Component\Database\ORM\Persistence\Configurator;
use Laventure\Component\Database\ORM\Persistence\EntityManager;
use Laventure\Component\Database\ORM\Persistence\Manager\EventManager;
use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\Factory\MetadataFactory;
use Laventure\Component\Database\ORM\Persistence\Mapping\ObjectMetadata;
use Laventure\Component\Filesystem\Filesystem;

require_once __DIR__.'/vendor/autoload.php';


/*
$filesystem = new Filesystem(__DIR__);
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
$builder = $em->createQueryBuilder();
*/

/*
$user = $em->find(\App\Entity\User::class, 1);

dd($em->getUnitOfWork()->getStorage());

#dd($user);
*/

/*
$select = $builder->select('*', true)
                  ->from('users', 'u')
                  ->map(\App\Entity\User::class)
                  ->fetch(Hydrate::ONE);

$results = $select->execute();

$select = $builder->select()
    ->from('users', 'u')
    ->where('u.active = 1')
    ->map(\App\Entity\User::class)
    #->hydrate(Hydrate::ALL)
;

#dd($select->getParameters());
$results = $select->fetch()->all();
dd($results);
#dd($em->getUnitOfWork()->getStorage());
*/


/*
$qb = new SelectBuilder($connection);

echo $qb->from('users', 'u')
    ->addSelect('c.id, c.count as count')
    ->join('cart c', 'u.cart_id = c.id')
    ->leftJoin('orders o', 'c.order_id = o.id')
    ->where('u.id = :userId')
    ->andWhere('c.id = :cartId')
    ->orWhere('o.id = :orderId')
    ->groupBy('c.count')
    ->having('count > 2')
    ->orderBy('u.name', 'desc')
    ->setMaxResults(5)
    ->setFirstResult(3)
    ->setParameter('userId', 1)
    ->setParameters(['cartId' => 3, 'orderId' => 7])
    ->getSQL();
*/

// ClassMetadata
/*
$metadata = new ClassMetadata(\App\Entity\User::class);
dump($metadata->getClassname());
dump($metadata->getTableName());
dump($metadata->getIdentifier());
dump($metadata->getMethods());
dump($metadata->hasMethod('getId'));

$user     = new \App\Entity\User();
$metadata = new ObjectMetadata($user);
dump($metadata->getAttributes());
*/

$factory = new MetadataFactory();

/*
$class   = $factory->createFromClass(\App\Entity\User::class);
dump($class->getClassname());
*/

$passwordEncoder = new \Laventure\Component\Security\Encoder\Password\PasswordEncoder();
$user     = new \App\Entity\User();
$user->setUsername('brown')
     ->setPassword($passwordEncoder->encodePassword('123'))
     ->setCreatedAt(new DateTimeImmutable())
     ->setActive(1);

$object  = $factory->createFromObject($user);

#dump($object->hasMany('products'));
dump($object->getTableName());
#dump($object->getIdentifiers());

