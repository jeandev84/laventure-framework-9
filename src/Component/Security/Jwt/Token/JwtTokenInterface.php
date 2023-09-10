<?php
namespace Laventure\Component\Security\Jwt\Token;



/**
 * @JwtTokenInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Jwt\Token
*/
interface JwtTokenInterface extends \Serializable
{
      /**
       * Returns access token
       *
       * @return string
      */
      public function getAccessToken();



      /**
       * Returns refresh token
       *
       * @return string
      */
      public function getRefreshToken();
}