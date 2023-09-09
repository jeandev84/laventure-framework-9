<?php
namespace Laventure\Component\Security\User\Provider;


use Laventure\Component\Security\User\UserInterface;

/**
 * @UserProviderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Provider
*/
interface UserProviderInterface
{
     /**
      * @param string $username
      *
      * @return UserInterface|null
     */
     public function findByUsername(string $username): ?UserInterface;
}