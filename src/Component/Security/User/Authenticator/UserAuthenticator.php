<?php
namespace Laventure\Component\Security\User\Authenticator;


use Laventure\Component\Security\Authentication\Authenticator;
use Laventure\Component\Security\Encoder\PasswordEncoder;
use Laventure\Component\Security\Encoder\PasswordEncoderInterface;
use Laventure\Component\Security\User\Encoder\Password\UserPasswordEncoder;
use Laventure\Component\Security\User\Encoder\Password\UserPasswordEncoderInterface;
use Laventure\Component\Security\User\Provider\UserProviderInterface;
use Laventure\Component\Security\User\Token\UserToken;
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
class UserAuthenticator extends Authenticator
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
     * @var UserPasswordEncoderInterface
    */
    protected UserPasswordEncoderInterface $encoder;



    /**
     * @param UserProviderInterface $provider
     *
     * @param UserTokenStorageInterface $tokenStorage
     *
     * @param UserPasswordEncoderInterface $encoder
    */
    public function __construct(
        UserProviderInterface $provider,
        UserTokenStorageInterface $tokenStorage,
        UserPasswordEncoderInterface $encoder
    )
    {
        $this->provider     = $provider;
        $this->tokenStorage = $tokenStorage;
        $this->encoder      = $encoder;
    }







    /**
     * @inheritDoc
    */
    public function authenticate(UserCredentials $payload): bool
    {
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
        return $this->tokenStorage->getToken()->getUser();
    }







    /**
     * @inheritDoc
    */
    public function logout(): bool
    {

    }






    /**
     * @inheritDoc
    */
    protected function saveUser(UserInterface $user): void
    {
         $this->tokenStorage->saveToken(new UserToken($user));
    }





    /**
     * @inheritDoc
    */
    protected function rememberUser(UserInterface $user): void
    {
          $this->tokenStorage->saveRememberMeToken($user);
    }





    /**
     * @inheritDoc
    */
    protected function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {
        return $this->encoder->isPasswordValid($user, $plainPassword);
    }




    /**
     * @inheritDoc
    */
    protected function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface
    {
        $rehashPassword = $this->encoder->encodePassword($user, $plainPassword);

        if ($this->encoder->needsRehash($user)) {
            $this->encoder->updatePasswordHash($user, $rehashPassword);
        }

        return $user;
    }





    /**
     * @return UserPasswordEncoderInterface
    */
    public function getEncoder(): UserPasswordEncoderInterface
    {
        return $this->encoder;
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
     * @param UserCredentials $payload
     *
     * @return UserInterface|false
    */
    private function attempt(UserCredentials $payload): ?UserInterface
    {
        $username = $payload->getUsername();
        $password = $payload->getPassword();

        // check user by identifier
        $user = $this->provider->findByUsername($username);

        // determine if user credentials valid
        if (! $user || ! $this->isPasswordValid($user, $password)) {
            return false;
        }

        // rehash user password
        return $this->rehashUserPassword($user, $password);
    }
}