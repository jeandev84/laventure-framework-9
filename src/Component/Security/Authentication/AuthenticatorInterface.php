<?php
namespace Laventure\Component\Security\Authentication;


use Laventure\Component\Security\User\UserCredentials;
use Laventure\Component\Security\User\UserInterface;


/**
 * @AuthenticatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Authentication
*/
interface AuthenticatorInterface
{


    /**
     * Authenticate user
     *
     * @param UserCredentials $payload
     *
     * @return bool
    */
    public function authenticate(UserCredentials $payload): bool;







    /**
     * Returns authenticated user
     *
     * @return UserInterface
    */
    public function getUser(): UserInterface;









    /**
     * Remove user session
     *
     * @return bool
    */
    public function logout(): bool;
}