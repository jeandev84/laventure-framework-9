<?php
namespace Laventure\Component\Security\Authorization;


use Laventure\Component\Security\User\UserInterface;

/**
 * @AuthorizationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authorization
*/
interface AuthorizationInterface
{
      /**
       * Determine if user has permissions
       *
       * @param UserInterface $user
       *
       * @param array $roles
       *
       * @return bool
      */
      public function hasPermissions(UserInterface $user, array $roles): bool;
}