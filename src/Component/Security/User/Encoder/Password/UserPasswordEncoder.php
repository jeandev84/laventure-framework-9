<?php
namespace Laventure\Component\Security\User\Encoder\Password;


use Laventure\Component\Security\Encoder\Password\PasswordEncoderInterface;
use Laventure\Component\Security\User\UserInterface;


/**
 * @UserPasswordEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Security\User\Encoder\Password
 */
class UserPasswordEncoder implements UserPasswordEncoderInterface
{


    /**
     * @var PasswordEncoderInterface
    */
    protected PasswordEncoderInterface $encoder;




    /**
     * @var UserPasswordRefreshInterface
    */
    protected UserPasswordRefreshInterface $passwordRefresh;




    /**
     * @param PasswordEncoderInterface $encoder
     *
     * @param UserPasswordRefreshInterface $passwordRefresh
    */
    public function __construct(PasswordEncoderInterface $encoder, UserPasswordRefreshInterface $passwordRefresh)
    {
         $this->encoder = $encoder;
         $this->passwordRefresh = $passwordRefresh;
    }




    /**
     * @inheritDoc
     */
    public function encodePassword(UserInterface $user, string $plainPassword): string
    {
        return $this->encoder->encodePassword($plainPassword, $user->getSalt());
    }





    /**
     * @inheritDoc
     */
    public function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {
        return $this->encoder->isPasswordValid($plainPassword, $user->getPassword());
    }




    /**
     * @inheritDoc
    */
    public function needsRehash(UserInterface $user): bool
    {
        return $this->encoder->needsRehash($user->getPassword());
    }





    /**
     * @inheritDoc
    */
    public function updatePasswordHash(UserInterface $user, string $rehashPassword): mixed
    {
        return $this->passwordRefresh->updatePasswordHash($user, $rehashPassword);
    }
}