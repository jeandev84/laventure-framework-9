<?php
namespace Laventure\Component\Security\User\Permissions;


use Laventure\Component\Security\User\UserInterface;

/**
 * @inheritdoc
*/
class UserPermission implements UserPermissionInterface
{

    /**
     * @inheritDoc
    */
    public function hasPermissions(UserInterface $user, array $roles): bool
    {
        return ! empty(array_intersect($roles, $user->getRoles()));
    }
}