<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Query\Logger\QueryLogger;
use Laventure\Component\Database\Connection\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Query\Result\QueryResultInterface;
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
     * @var string
     */
    protected string $mappedClass;





    /**
     * @var array
     */
    protected array $parameters = [];







    /**
     * @var int[]
    */
    protected array $bindTypes = [
        self::PARAM_NULL => \PDO::PARAM_NULL,
        self::PARAM_INT  => \PDO::PARAM_INT,
        self::PARAM_STR  => PDO::PARAM_STR,
        self::PARAM_BOOL => \PDO::PARAM_BOOL,
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
    public function map(string $classname): static
    {
         $this->statement->setFetchMode(PDO::FETCH_CLASS, $classname);
         $this->mappedClass = $classname;

         return $this;
    }





    /**
     * @param $name
     *
     * @param $value
     *
     * @param int $type
     *
     * @return $this
    */
    public function bindParam($name, $value, int $type): static
    {
        $this->statement->bindParam($name, $value, $this->bind($type));
        $this->logger->bindedParams(compact('name', 'value', 'type'));

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function bindParams(array $params): static
    {
         foreach ($params as $binds) {
             [$name, $value, $type] = $binds;
             $this->bindParam($name, $value, $type);
         }

         return $this;
    }





    /**
     * @param $name
     *
     * @param $value
     *
     * @param int $type
     *
     * @return $this
    */
    public function bindValue($name, $value, int $type): static
    {
          $this->statement->bindValue($name, $value, $this->bind($type));
          $this->logger->bindedValues(compact('name', 'value', 'type'));

          return $this;
    }







    /**
     * @inheritDoc
    */
    public function bindValues(array $values): static
    {
        foreach ($values as $binds) {
            [$name, $value, $type] = $binds;
            $this->bindValue($name, $value, $type);
        }

        return $this;
    }







    /**
     * @param $name
     *
     * @param $value
     *
     * @param int $type
     *
     * @param int $maxLength
     *
     * @param mixed|null $driverOptions
     *
     * @return $this
    */
    public function bindColumn($name, $value, int $type, int $maxLength = 0, mixed $driverOptions = null): static
    {
         $this->statement->bindColumn($name, $value, $type, $maxLength, $driverOptions);
         $this->logger->bindedColumns(compact('name', 'value', 'type', 'maxLength', 'driverOptions'));

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function bindColumns(array $columns): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        $this->parameters = $parameters;
        $this->logger->queryParameters($parameters);

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
                $this->logger->logExecutedQuery($this->getSQL());
            }
            return $this->lastId ?: $status;
        } catch (\PDOException $e) {
            return $this->logger->logErrorQuery($this->getSQL(), $e);
        }
    }







    /**
     * @inheritDoc
    */
    public function exec(string $sql): false|int
    {
        try {

            if(! $affectedRows = $this->pdo->exec($sql)) {
                return false;
            }

            $this->logger->logExecutedQuery($sql);
            return $affectedRows;
        } catch (PDOException $e) {
            return $this->logger->logErrorQuery($sql, $e);
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
    public function getLogger(): QueryLoggerInterface
    {
        return $this->logger;
    }





    /**
     * @param int $type
     *
     * @return int
    */
    private function bind(int $type): int
    {
        if (! isset($this->bindTypes[$type])) {
            throw new \RuntimeException("unavailable type [$type]");
        }

        return $this->bindTypes[$type];
    }
}