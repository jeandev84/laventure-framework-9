<?php
namespace Laventure\Component\Security\User\Encoder\Password;


use Laventure\Component\Security\Encoder\Password\PasswordEncoder;
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
     * @param UserPasswordRefreshInterface $passwordRefresh
     *
     * @param PasswordEncoderInterface $encoder
    */
    public function __construct(UserPasswordRefreshInterface $passwordRefresh, PasswordEncoderInterface $encoder)
    {
         $this->passwordRefresh = $passwordRefresh;
         $this->encoder = $encoder;
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
    public function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface
    {
          $rehashPassword = $this->encodePassword($user, $plainPassword);

          if ($this->needsRehash($user)) {
               $this->passwordRefresh->updatePasswordHash($user, $rehashPassword);
          }

          return $user;
    }
}