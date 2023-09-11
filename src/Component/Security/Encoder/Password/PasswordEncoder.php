<?php
namespace Laventure\Component\Security\Encoder\Password;


/**
 * @inheritdoc
 *
 * @see https://www.php.net/manual/en/function.password-hash.php
*/
class PasswordEncoder implements PasswordEncoderInterface
{

    const COST_MIN = 4;
    const COST_MAX = 12;
    const DEFAULT  = 'default';
    const BCRYPT   = 'bcrypt';



    /**
     * Encoder algorithm
     *
     * @var string
    */
    protected string $algo;



    /**
     * Encoder options
     *
     * @var array
    */
    protected array $options = [];




    /**
     * @var array
    */
    protected array $algoTypes = [
        self::DEFAULT => PASSWORD_DEFAULT,
        self::BCRYPT  => PASSWORD_BCRYPT
    ];




    /**
     * @param string $algo
    */
    public function __construct(string $algo = 'default')
    {
         $this->algo($algo);
    }





    /**
     * @param string $name
     *
     * @return $this
    */
    public function algo(string $name): static
    {
        $this->algo = $name;

        return $this;
    }





    /**
     * @param int $cost
     *
     * @return $this
    */
    public function cost(int $cost): static
    {
        if ($cost < self::COST_MIN || $cost > self::COST_MAX) {
            throw new \InvalidArgumentException('Cost must be in the range of 4-12');
        }

        return $this->options(compact('cost'));
    }





    /**
     * @inheritDoc
    */
    public function encodePassword(string $plainPassword, string $salt = null): string
    {
        [$password, $algo] = $this->resolveParams($plainPassword, $salt);

        if (! $hash = password_hash($password, $algo, $this->options)) {
             throw new \RuntimeException(ucfirst($this->algo) . " not supported.");
        }

        return $hash;
    }




    /**
     * @inheritDoc
    */
    public function isPasswordValid(string $plainPassword, string $hash): bool
    {
        return password_verify($plainPassword, $hash);
    }




    /**
     * @inheritDoc
    */
    public function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, $this->algo, $this->options);
    }




    /**
     * @inheritDoc
    */
    public function getAlgo(): string
    {
        return $this->algo;
    }





    /**
     * @param array $options
     *
     * @return $this
    */
    protected function options(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }





    /**
     * @param string $plainPassword
     *
     * @param string|null $salt
     *
     * @return array
    */
    private function resolveParams(string $plainPassword, string $salt = null): array
    {
        if (! array_key_exists($this->algo, $this->algoTypes)) {
            throw new InvalidPasswordAlgoException($this->algo);
        }

        if ($this->isBcrypt($this->algo)) {
            $this->options(compact('salt'));
        }

        $algo = $this->algoTypes[$this->algo];

        return [$plainPassword, $algo];
    }




    /**
     * @param string $algo
     *
     * @return bool
    */
    private function isBcrypt(string $algo): bool
    {
        return $algo === self::BCRYPT;
    }
}