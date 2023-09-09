<?php
namespace Laventure\Component\Security\Authentication;


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
     * @param string $username
     *
     * @param string $password
     *
     * @param bool $rememberMe
     *
     * @return bool
    */
    public function authenticate(string $username, string $password, bool $rememberMe = false): bool;







    /**
     * @return UserInterface
    */
    public function getUser(): UserInterface;








    /**
     * Logout user
     *
     * @return bool
    */
    public function logout(): bool;
}