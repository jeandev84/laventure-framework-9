<?php
namespace Laventure\Component\Security\User\Encoder\Password;

use Laventure\Component\Security\User\UserInterface;

interface UserPasswordRefreshInterface
{

    /**
     * @param UserInterface $user
     *
     * @param string $rehashPassword
     *
     * @return mixed
    */
    public function updatePasswordHash(UserInterface $user, string $rehashPassword): mixed;
}