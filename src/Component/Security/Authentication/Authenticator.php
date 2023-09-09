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
     * @param UserInterface $user
     *
     * @return UserTokenInterface
    */
    abstract protected function createUserToken(UserInterface $user): UserTokenInterface;
}