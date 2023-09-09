<?php
namespace Laventure\Component\Security\Encoder;


/**
 * @inheritdoc
*/
class PasswordEncoder implements PasswordEncoderInterface
{

    /**
     * @inheritDoc
    */
    public function encodePassword(string $plainPassword, string $salt = null): string
    {

    }




    /**
     * @inheritDoc
    */
    public function isPasswordValid(string $plainPassword, string $hash): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function needsRehash(string $hash): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getAlgo(): string
    {

    }
}