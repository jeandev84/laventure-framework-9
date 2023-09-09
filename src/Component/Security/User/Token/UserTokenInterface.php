<?php
namespace Laventure\Component\Security\User\Token;

use Laventure\Component\Security\User\UserInterface;


/**
 * @UserTokenInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Token
*/
interface UserTokenInterface extends \Serializable
{
     /**
      * @return UserInterface
     */
     public function getUser(): UserInterface;
}