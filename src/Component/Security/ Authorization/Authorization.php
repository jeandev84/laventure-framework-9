<?php
namespace Laventure\Component\Security\Authorization;


use Laventure\Component\Security\User\UserInterface;


/**
 * @inheritdoc
*/
class Authorization implements AuthorizationInterface
{

    /**
     * @inheritDoc
    */
    public function hasPermissions(UserInterface $user, array $roles): bool
    {
        return ! empty(array_intersect($roles, $user->getRoles()));
    }
}