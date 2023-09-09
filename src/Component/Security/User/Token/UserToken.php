<?php
namespace Laventure\Component\Security\User\Token;


use Laventure\Component\Security\User\UserInterface;

/**
 * @inheritdoc
*/
class UserToken implements UserTokenInterface
{


    /**
     * @param UserInterface $user
    */
    public function __construct(protected UserInterface $user)
    {
    }



    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        return $this->user;
    }




    /**
     * @inheritDoc
    */
    public function serialize(): ?string
    {
        return serialize($this);
    }




    /**
     * @inheritDoc
    */
    public function unserialize(string $data)
    {

    }




    public function __serialize(): array
    {

    }


    public function __unserialize(array $data): void
    {

    }
}