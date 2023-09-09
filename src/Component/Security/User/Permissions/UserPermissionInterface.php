<?php
namespace Laventure\Component\Security\User\Permissions;


use Laventure\Component\Security\User\UserInterface;

/**
 * @UserPermissionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Permissions
*/
interface UserPermissionInterface
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