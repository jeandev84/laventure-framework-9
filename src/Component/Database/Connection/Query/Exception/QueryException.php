<?php
namespace Laventure\Component\Database\Connection\Query;


use Throwable;

/**
 * @inheritdoc
*/
class QueryException extends \Exception implements QueryExceptionInterface
{


    /**
     * @var string
    */
    protected string $sql;




    /**
     * @var array
    */
    protected array $parameters = [];




    /**
     * @param string $sql
     *
     * @param string $message
     *
     * @param Throwable|null $previous
    */
    public function __construct(string $sql, string $message = "",  ?Throwable $previous = null)
    {
         parent::__construct($message, 500, $previous);
         $this->sql = $sql;
    }




    /**
     * @param array $parameters
    */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }






    /**
     * @inheritDoc
    */
    public function getSQl(): string
    {
        return $this->sql;
    }




    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
         return $this->parameters;
    }





    /**
     * @inheritdoc
    */
    public function __toString(): string
    {
        return date('Y-m-d H:i:s'). "[$this->code] $this->sql: $this->message | $this->file | $this->line";
    }
}