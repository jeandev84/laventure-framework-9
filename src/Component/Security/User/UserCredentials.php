<?php
namespace Laventure\Component\Security\User;

class UserCredentials
{

    /**
     * @param string $username
     *
     * @param string $password
     *
     * @param bool $rememberMe
    */
    public function __construct(
        protected string $username,
        protected string $password,
        protected bool $rememberMe = false
    )
    {
    }




    /**
     * Returns user name
     *
     * @return string
    */
    public function getUsername(): string
    {
        return $this->username;
    }




    /**
     * Returns user password
     *
     * @return string
    */
    public function getPassword(): string
    {
        return $this->password;
    }




    /**
     * Determine if user must be remembered
     *
     * @return bool
    */
    public function isRememberMe(): bool
    {
        return $this->rememberMe;
    }
}