<?php
namespace Laventure\Component\Security\User;


/**
 * @UserInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User
*/
interface UserInterface
{

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @return string
    */
    public function getIdentifier(): string;




    /**
     * @return string|null
    */
    public function getPassword(): ?string;





    /**
     * Returns salt for encoding user password
     *
     * @return string|null
    */
    public function getSalt(): ?string;





    /**
     * Returns user roles
    */
    public function getRoles(): array;






    /**
     * @return bool
    */
    public function enabled(): bool;






    /**
     * @return void
    */
    public function eraseCredentials(): void;
}