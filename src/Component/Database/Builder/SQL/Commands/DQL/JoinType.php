<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;

class JoinType
{
    const JOIN       = 'JOIN';
    const LEFT_JOIN  = 'LEFT_JOIN';
    const RIGHT_JOIN = 'RIGHT_JOIN';
    const INNER_JOIN = 'INNER_JOIN';
    const FULL_JOIN  = 'FULL_JOIN';


    public static function types(): array
    {
         return [
             self::JOIN       => 'join',
             self::LEFT_JOIN  => 'rightJoin',
             self::RIGHT_JOIN => 'rightJoin',
             self::INNER_JOIN => 'innerJoin',
             self::FULL_JOIN  => 'fullJoin'
         ];
    }
}