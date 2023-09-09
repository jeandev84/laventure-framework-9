<?php
namespace Laventure\Component\Security;


use Laventure\Component\Security\Authentication\AuthenticatorInterface;
use Laventure\Component\Security\User\Permissions\UserPermission;
use Laventure\Component\Security\User\UserCredentials;
use Laventure\Component\Security\User\UserInterface;


/**
 * @Auth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security
*/
class Auth
{


    /**
     * @var AuthenticatorInterface
    */
    protected AuthenticatorInterface $authenticator;



    /**
     * @var UserPermission
    */
    protected UserPermission $permission;




    /**
     * @param AuthenticatorInterface $authenticator
    */
    public function __construct(AuthenticatorInterface $authenticator)
    {
         $this->authenticator = $authenticator;
         $this->permission    = new UserPermission();
    }






    /**
     * Authentication user
     *
     * @param string $username
     *
     * @param string $password
     *
     * @param bool $rememberMe
     *
     * @return bool
    */
    public function attempt(string $username, string $password, bool $rememberMe = false): bool
    {
        return $this->authenticator->authenticate(new UserCredentials($username, $password, $rememberMe));
    }






    /**
     * Returns authenticated user
     *
     * @return UserInterface
    */
    public function getUser(): UserInterface
    {
         return $this->authenticator->getUser();
    }







    /**
     * Authorize user
     *
     * @param array $roles
     *
     * @return bool
    */
    public function isGranted(array $roles): bool
    {
          return $this->permission->hasPermissions($this->getUser(), $roles);
    }






    /**
     * Destroy user session
     *
     * @return bool
    */
    public function logout(): bool
    {
         return $this->authenticator->logout();
    }
}