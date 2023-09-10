<?php
namespace Laventure\Component\Security\Jwt\Token;


use Laventure\Component\Security\User\UserInterface;

/**
 * @JwtTokenStorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Jwt\Token
*/
interface JwtTokenStorageInterface
{

      /**
       * @param UserInterface $user
       *
       * @return JwtTokenInterface
      */
      public function saveToken(UserInterface $user): JwtTokenInterface;





      /**
       * Returns jwt token
       *
       * @return JwtTokenInterface
      */
      public function getToken(): JwtTokenInterface;
}