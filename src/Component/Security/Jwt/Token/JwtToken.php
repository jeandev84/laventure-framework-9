<?php
namespace Laventure\Component\Security\Jwt\Token;


/**
 * @inheritdoc
*/
class JwtToken implements JwtTokenInterface
{

    /**
     * @param string $accessToken
     *
     * @param string $refreshToken
    */
    public function __construct(protected string $accessToken, protected string $refreshToken)
    {
    }





    /**
     * @inheritDoc
    */
    public function serialize()
    {
         return serialize($this);
    }





    /**
     * @inheritDoc
    */
    public function unserialize(string $data)
    {

    }





    /**
     * @inheritDoc
    */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }





    /**
     * @inheritDoc
    */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }




    /**
     * @return array
    */
    public function __serialize(): array
    {

    }





    /**
     * @param array $data
     *
     * @return void
    */
    public function __unserialize(array $data): void
    {

    }
}