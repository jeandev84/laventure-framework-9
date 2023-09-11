<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Query\QueryLogger;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;
use PDO;
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
     * @var string
     */
    protected string $sql = '';




    /**
     * @var array
     */
    protected array $bindings = [];






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

        $this->logger->logBindParams(compact('name', 'value', 'type'));

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function bindValue($name, $value, int $type = self::NULL): static
    {
        $bind = $this->bindingType($type);

        $this->statement->bindValue($name, $value, $bind);

        $this->logger->logBindValues(compact('name', 'value', 'type'));

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
        // TODO: Implement setParameters() method.
    }

    /**
     * @inheritDoc
     */
    public function execute(): int|bool
    {
        // TODO: Implement execute() method.
    }

    /**
     * @inheritDoc
     */
    public function exec(string $sql): mixed
    {
        // TODO: Implement exec() method.
    }

    /**
     * @inheritDoc
     */
    public function fetch(): QueryResultInterface
    {
        // TODO: Implement fetch() method.
    }

    /**
     * @inheritDoc
     */
    public function lastId(): int
    {
        // TODO: Implement lastId() method.
    }

    /**
     * @inheritDoc
     */
    public function getLogger(): QueryLogger
    {
        // TODO: Implement getLogger() method.
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
}