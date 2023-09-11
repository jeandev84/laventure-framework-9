<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Exception;
use Laventure\Component\Database\Connection\Query\QueryException;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Query\QueryLogger;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;
use PDO;
use PDOException;
use PDOStatement;


/**
 * @inheritdoc
*/
class Query implements QueryInterface
{


    /**
     * @var PDO
     */
    protected PDO $pdo;




    /**
     * @var PDOStatement
     */
    protected PDOStatement $statement;






    /**
     * @var QueryLogger
     */
    protected QueryLogger $logger;




    /**
     * @var int
    */
    protected int $lastId = 0;






    /**
     * @var array
     */
    protected array $parameters = [];







    /**
     * @var array
    */
    protected array $bindTypes = [
        self::NULL => \PDO::PARAM_NULL,
        self::INT  => \PDO::PARAM_INT,
        self::STR  => PDO::PARAM_STR,
        self::BOOL => \PDO::PARAM_BOOL,
    ];






    /**
     * @param PDO $pdo
    */
    public function __construct(PDO $pdo)
    {
        $this->pdo       = $pdo;
        $this->statement = new PDOStatement();
        $this->logger    = new QueryLogger();
    }




    /**
     * @inheritDoc
    */
    public function prepare(string $sql): static
    {
        $this->statement = $this->pdo->prepare($sql);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function bindParam($name, $value, int $type = self::NULL): static
    {
        $bind = $this->bindingType($type);

        $this->statement->bindParam($name, $value, $bind);

        $this->logger->addBindParams(compact('name', 'value', 'type'));

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function bindValue($name, $value, int $type = self::NULL): static
    {
        $bind = $this->bindingType($type);

        $this->statement->bindValue($name, $value, $bind);

        $this->logger->addBindValues(compact('name', 'value', 'type'));

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        $this->parameters = $parameters;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function execute(): int|bool
    {
        try {

            if ($status = $this->statement->execute($this->parameters)) {
                $this->lastId = (int)$this->pdo->lastInsertId();
                $this->logger->logExcecutedQuery($this->getSQL());
            }

        } catch (\PDOException $e) {
            $this->logger->logErrorQuery($this->getSQL(), $e);
        }

        return $this->lastId ?: $status;
    }






    /**
     * @inheritDoc
    */
    public function exec(string $sql): false|int
    {
        try {

            if(! $status = $this->pdo->exec($sql)) {
                return false;
            }

            $this->logger->logExcecutedQuery($sql);
            return $status;

        } catch (PDOException $e) {
            $this->logger->logErrorQuery($sql, $e);
        }
    }





    /**
     * @inheritDoc
    */
    public function fetch(): QueryResultInterface
    {
        $this->execute();

        return new QueryResult($this->statement);
    }





    /**
     * @inheritDoc
    */
    public function lastId(): int
    {
        return $this->lastId;
    }






    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->statement->queryString;
    }






    /**
     * @inheritDoc
    */
    public function getLogger(): QueryLogger
    {
        return $this->logger;
    }





    /**
     * @param int $type
     * @return mixed
    */
    private function bindingType(int $type): mixed
    {
        if (! array_key_exists($type, $this->bindTypes)) {
            throw new \RuntimeException("unavailable type [$type]");
        }

        return $this->bindTypes[$type];
    }






    /**
     * @param Exception $e
     *
     * @return void
    */
    private function abort(Exception $e): void
    {
        (function () use ($e) {
            throw new QueryException($e->getMessage(), $e->getCode());
        })();
    }
}