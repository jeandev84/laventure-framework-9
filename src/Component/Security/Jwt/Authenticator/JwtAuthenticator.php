<?php
namespace Laventure\Component\Security\Jwt\Authenticator;

use Laventure\Component\Security\Authentication\AuthenticatorInterface;
use Laventure\Component\Security\Jwt\Encoder\JwtEncoder;
use Laventure\Component\Security\Jwt\Token\JwtTokenStorageInterface;
use Laventure\Component\Security\User\Authenticator\UserAuthenticator;
use Laventure\Component\Security\User\UserInterface;


/**
 * @inheritdoc
*/
class JwtAuthenticator implements AuthenticatorInterface
{


    /**
     * @var UserAuthenticator
    */
    protected UserAuthenticator $authenticator;



    /**
     * @var JwtEncoder
    */
    protected JwtEncoder $encoder;




    /**
     * @var JwtTokenStorageInterface
    */
    protected JwtTokenStorageInterface $tokenStorage;


    /**
     * @param UserAuthenticator $authenticator
     *
     * @param JwtTokenStorageInterface $tokenStorage
    */
    public function __construct(UserAuthenticator $authenticator, JwtTokenStorageInterface $tokenStorage)
    {
         $this->authenticator = $authenticator;
         $this->tokenStorage  = $tokenStorage;
    }





    /**
     * @inheritDoc
    */
    public function authenticate(string $username, string $password, bool $rememberMe = false): bool
    {
         // try to authenticate user
         if(! $this->authenticator->authenticate($username, $password, $rememberMe)) {
              return false;
         }

         // store jwt token
         $this->tokenStorage->saveToken($this->getUser());

         return true;
    }







    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        return $this->authenticator->getUser();
    }






    /**
     * @inheritDoc
    */
    public function isGranted(array $roles): bool
    {
        return $this->authenticator->isGranted($roles);
    }







    /**
     * @inheritDoc
    */
    public function logout(): bool
    {
        return $this->authenticator->logout();
    }





    /**
     * @return JwtTokenStorageInterface
    */
    public function getTokenStorage(): JwtTokenStorageInterface
    {
        return $this->tokenStorage;
    }
}