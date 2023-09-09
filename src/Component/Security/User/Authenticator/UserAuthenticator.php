<?php
namespace Laventure\Component\Security\User\Authenticator;


use Laventure\Component\Security\Authentication\Authenticator;
use Laventure\Component\Security\User\Provider\UserProviderInterface;
use Laventure\Component\Security\User\Token\UserTokenInterface;
use Laventure\Component\Security\User\Token\UserTokenStorageInterface;
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
    protected UserProviderInterface $userProvider;



    /**
     * @var UserTokenStorageInterface
    */
    protected UserTokenStorageInterface $userTokenStorage;




    /**
     * @param UserProviderInterface $userProvider
     *
     * @param UserTokenStorageInterface $tokenStorage
    */
    public function __construct(UserProviderInterface $userProvider, UserTokenStorageInterface $tokenStorage)
    {
    }




    /**
     * @inheritDoc
    */
    public function authenticate(string $username, string $password, bool $rememberMe = false): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {

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
    protected function createToken(UserInterface $user): UserTokenInterface
    {

    }




    /**
     * @inheritDoc
    */
    protected function createRememberMeToken(UserInterface $user): mixed
    {

    }




    /**
     * @inheritDoc
    */
    protected function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {

    }




    /**
     * @inheritDoc
    */
    protected function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface
    {

    }
}