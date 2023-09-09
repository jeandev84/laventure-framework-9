<?php
namespace Laventure\Component\Security\Authentication;


use Laventure\Component\Security\User\Token\UserTokenInterface;
use Laventure\Component\Security\User\UserInterface;


/**
 * @inheritdoc
*/
abstract class Authenticator implements AuthenticatorInterface
{






    /**
     * Create user token
     *
     * @param UserInterface $user
     *
     * @return void
    */
    abstract protected function saveUser(UserInterface $user): void;







    /**
     * Create remember me token
     *
     * @param UserInterface $user
     *
     * @return void
    */
    abstract protected function rememberUser(UserInterface $user): void;







    /**
     * Determine if user password is valid
     *
     * @param UserInterface $user
     *
     * @param string $plainPassword
     *
     * @return bool
    */
    abstract protected function isPasswordValid(UserInterface $user, string $plainPassword): bool;






    /**
     * Rehash user password
     *
     * @param UserInterface $user
     *
     * @param string $plainPassword
     *
     * @return UserInterface
    */
    abstract protected function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface;
}