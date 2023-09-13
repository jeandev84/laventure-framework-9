<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;

class Hydrate
{

    const ALL     = 0;
    const ONE     = 1;
    const ARRAY   = 2;
    const COLUMNS = 3;




    /**
     * @var array|string[]
    */
    public static array $handlers = [
        self::ALL     => 'getResult',
        self::ONE     => 'getOneOrNullResult',
        self::ARRAY   => 'getArrayResult',
        self::COLUMNS => 'getArrayColumns',
    ];
}