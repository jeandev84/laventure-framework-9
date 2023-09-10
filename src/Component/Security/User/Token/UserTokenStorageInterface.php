<?php
namespace Laventure\Component\Security\User\Token;

use Laventure\Component\Security\User\UserInterface;


/**
 * @UserTokenStorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User
*/
interface UserTokenStorageInterface
{




       /**
        * @param UserInterface $user
        *
        * @return UserTokenInterface
       */
       public function saveToken(UserInterface $user): UserTokenInterface;







       /**
        * Determine if token key exist
        *
        * @return bool
       */
       public function hasToken(): bool;







      /**
       * Remove UserToken
       *
       * @param UserInterface $user
       * @return mixed
      */
      public function removeToken(UserInterface $user): mixed;







      /**
       * Save remember me token
       *
       * @param UserInterface $user
       *
       * @return mixed
      */
      public function saveRememberMeToken(UserInterface $user): mixed;






      /**
       * Remove remember me token
       *
       * @param UserInterface $user
       *
       * @return mixed
      */
      public function removeRememberMeToken(UserInterface $user): mixed;










      /**
       * Return user token
       *
       * @return UserTokenInterface
      */
      public function getToken(): UserTokenInterface;
}