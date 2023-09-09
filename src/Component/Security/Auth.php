<?php
namespace Laventure\Component\Security;


use Laventure\Component\Security\Authentication\AuthenticatorInterface;
use Laventure\Component\Security\Authorization\Authorization;
use Laventure\Component\Security\Authorization\AuthorizationInterface;
use Laventure\Component\Security\User\UserInterface;


/**
 * Authentication manager
 *
 *
 * @Auth
 *
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
     * @var AuthorizationInterface
    */
    protected AuthorizationInterface $authorization;




    /**
     * @param AuthenticatorInterface $authenticator
     *
     * @param AuthorizationInterface|null $authorization
    */
    public function __construct(AuthenticatorInterface $authenticator, AuthorizationInterface $authorization = null)
    {
         $this->authenticator = $authenticator;
         $this->authorization = $authorization ?: new Authorization();
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
        return $this->authenticator->authenticate($username, $password, $rememberMe);
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
          return $this->authorization->hasPermissions($this->getUser(), $roles);
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