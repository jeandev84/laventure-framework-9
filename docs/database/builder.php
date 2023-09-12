<?php

use Laventure\Component\Database\Builder\SQL\Commands\DML\InsertBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DML\UpdateBuilder;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\SelectBuilder;

require_once __DIR__.'/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);
$config     = $filesystem->load('config/database.php');

$manager = new \Laventure\Component\Database\Manager\DatabaseManager();
$manager->open($config['connection'], $config['connections']);
$connection = $manager->connection();

# dd($connection);

/*
SELECT BUILDER:

$select = new SelectBuilder($connection);

echo $select->from('users', 'u')
           ->addSelect('c.id, c.count as count')
           ->join('cart c', 'u.cart_id = c.id')
           ->leftJoin('orders o', 'c.order_id = o.id')
           ->where('u.id = :userId')
           ->andWhere('c.id = :cartId')
           ->orWhere('o.id = :orderId')
           ->groupBy('c.count')
           ->having('count > 2')
           ->orderBy('u.name', 'desc')
           ->limit(5)
           ->offset(3)
           ->setParameter('userId', 1)
           ->setParameters(['cartId' => 3, 'orderId' => 7])
           ->getSQL();

SELECT *, c.id, c.count as count
FROM users u
JOIN cart c ON u.cart_id = c.id
LEFT JOIN orders o ON c.order_id = o.id
WHERE u.id = :userId AND c.id = :cartId OR o.id = :orderId
GROUP BY c.count
HAVING count > 2
ORDER BY u.name desc
LIMIT 5 OFFSET 3;
echo "\n";


// INSERT BUILDER:

$insert = new InsertBuilder($connection, 'users');
$insert->insert([
    'username'   => 'jean333',
    'password'   => password_hash('123', PASSWORD_DEFAULT),
    'active'     => 1,
    'created_at' => date('Y-m-d H:i:s')
]);

dump($insert->getColumns());
dump($insert->getAttributes());
dd($insert->getSQL());

$insert->insert([
    'username'   => 'jean333',
    'password'   => password_hash('123', PASSWORD_DEFAULT),
    'active'     => 1,
    'created_at' => date('Y-m-d H:i:s')
]);
->set('test', 4)
->set('username', ':username')
->set('password', ':password')
->set('active', ':active')
->set('created_at', ':created_at');


dump($insert->getColumns());
dump($insert->getAttributes());

$arrays = [
    [
        'username'   => 'jean333',
        'password'   => password_hash('123', PASSWORD_DEFAULT),
        'active'     => 1,
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'username'   => 'jean333',
        'password'   => password_hash('123', PASSWORD_DEFAULT),
        'active'     => 1,
        'created_at' => date('Y-m-d H:i:s')
    ]
];



$insert->insert([
   'username'   => 'jean333',
   'password'   => password_hash('123', PASSWORD_DEFAULT),
   'active'     => 1,
   'created_at' => date('Y-m-d H:i:s')
])->set('test', 4);

$insert->attributes([
   [
       'username'   => 'jean333',
       'password'   => password_hash('123', PASSWORD_DEFAULT),
       'active'     => 1,
       'created_at' => date('Y-m-d H:i:s')
   ],
   [
        'username'   => 'jean333',
        'password'   => password_hash('123', PASSWORD_DEFAULT),
        'active'     => 1,
        'created_at' => date('Y-m-d H:i:s')
   ]
]);


dump($insert->getAttributes());
dump($insert->count());
dd($insert->getSQL());


// UPDATE BUILDER

$update = new UpdateBuilder($connection, 'users');

echo $update->update([
    'username'   => 'jean333!!!',
    'password'   => password_hash('3456', PASSWORD_DEFAULT),
])
->set('active', 1)
->where('id = :id')
->andWhere('name = :name')
->setParameter('id', 3)
->setParameter('name', 'brown')
->getSQL();


dd($update);

echo "\n";


$delete = new \Laventure\Component\Database\Builder\SQL\Commands\DML\DeleteBuilder($connection, 'users');

echo $delete->andWhere('id = :id')
            ->delete(['name' => 'test'])
            ->setParameter('id', 1)
            ->getSQL();

echo "\n";
*/


