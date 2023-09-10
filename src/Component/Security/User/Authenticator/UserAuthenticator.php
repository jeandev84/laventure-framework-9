<?php
namespace Laventure\Component\Security\User\Authenticator;


use Laventure\Component\Security\Authentication\AuthenticatorInterface;
use Laventure\Component\Security\User\Encoder\Password\UserPasswordEncoder;
use Laventure\Component\Security\User\Encoder\Password\UserPasswordEncoderInterface;
use Laventure\Component\Security\User\Permissions\UserPermission;
use Laventure\Component\Security\User\Provider\UserProviderInterface;
use Laventure\Component\Security\User\Token\UserToken;
use Laventure\Component\Security\User\Token\UserTokenException;
use Laventure\Component\Security\User\Token\UserTokenInterface;
use Laventure\Component\Security\User\Token\UserTokenStorageInterface;
use Laventure\Component\Security\User\UserCredentials;
use Laventure\Component\Security\User\UserInterface;


/**
 * @UserAuthenticator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Authenticator
*/
class UserAuthenticator implements AuthenticatorInterface
{



    /**
     * @var UserProviderInterface
    */
    protected UserProviderInterface $provider;



    /**
     * @var UserTokenStorageInterface
    */
    protected UserTokenStorageInterface $tokenStorage;




    /**
     * @var UserPasswordEncoder
    */
    protected UserPasswordEncoder $encoder;




    /**
     * @var UserPermission
    */
    protected UserPermission $permission;





    /**
     * @param UserProviderInterface $provider
     *
     * @param UserTokenStorageInterface $tokenStorage
     *
     * @param UserPasswordEncoder $encoder
    */
    public function __construct(UserProviderInterface $provider, UserTokenStorageInterface $tokenStorage, UserPasswordEncoder $encoder)
    {
        $this->provider     = $provider;
        $this->tokenStorage = $tokenStorage;
        $this->encoder      = $encoder;
        $this->permission   = new UserPermission();
    }







    /**
     * @inheritDoc
    */
    public function authenticate(string $username, string $password, bool $rememberMe = false): bool
    {
         $payload = new UserCredentials($username, $password, $rememberMe);

         if (! $user = $this->attempt($payload)) {
              return false;
         }

         // save user session
         $this->saveUser($user);

         // remember user
         if ($payload->isRememberMe()) {
            $this->rememberUser($user);
         }

         return true;
    }






    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        if (! $this->tokenStorage->hasToken()) {
             throw new UserTokenException("unavailable user token in storage.");
        }

        return $this->tokenStorage->getToken()->getUser();
    }






    /**
     * @inheritDoc
    */
    public function isGranted(array $roles): bool
    {
         return $this->permission->hasPermissions($this->getUser(), $roles);
    }






    /**
     * @inheritDoc
    */
    public function logout(): bool
    {
        return $this->tokenStorage->removeToken($this->getUser());
    }






    /**
     * @return UserProviderInterface
    */
    public function getProvider(): UserProviderInterface
    {
        return $this->provider;
    }




    /**
     * @return UserTokenStorageInterface
    */
    public function getTokenStorage(): UserTokenStorageInterface
    {
        return $this->tokenStorage;
    }





    /**
     * @return UserPasswordEncoderInterface
    */
    public function getEncoder(): UserPasswordEncoderInterface
    {
        return $this->encoder;
    }





    /**
     * @param UserCredentials $payload
     *
     * @return UserInterface|false
    */
    private function attempt(UserCredentials $payload): UserInterface|false
    {
        $password = $payload->getPassword();

        // check user by identifier
        $user = $this->provider->findByUsername($payload->getUsername());

        // determine if user credentials valid
        if (! $user || !$this->isPasswordValid($user, $password)) {
            return false;
        }

        // rehash user password
        return $this->rehashUserPassword($user, $password);
    }






    /**
     * @param UserInterface $user
     *
     * @param string $plainPassword
     *
     * @return bool
    */
    private function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {
        return $this->encoder->isPasswordValid($user, $plainPassword);
    }





    /**
     * @param UserInterface $user
     *
     * @param string $plainPassword
     *
     * @return UserInterface
    */
    private function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface
    {
        $rehashPassword = $this->encoder->encodePassword($user, $plainPassword);

        if ($this->encoder->needsRehash($user)) {
            $this->encoder->updatePasswordHash($user, $rehashPassword);
        }

        return $user;
    }







    /**
     * @param UserInterface $user
     *
     * @return void
    */
    private function saveUser(UserInterface $user): void
    {
        $this->tokenStorage->saveToken($user);
    }






    /**
     * @param UserInterface $user
     *
     * @return void
    */
    private function rememberUser(UserInterface $user): void
    {
        $this->tokenStorage->saveRememberMeToken($user);
    }
}