<?php
namespace Laventure\Component\Database\Connection\Query\Logger;


use Laventure\Component\Database\Connection\Query\QueryException;
use Throwable;

/**
 * @inheritdoc
*/
class QueryLogger implements QueryLoggerInterface
{


    /**
     * @var array
     */
    protected array $bindParams = [];




    /**
     * @var array
    */
    protected array $bindValues = [];





    /**
     * @var array
    */
    protected array $bindColumns = [];





    /**
     * @var array
    */
    protected array $parameters = [];






    /**
     * @var array
    */
    protected array $log = [];






    /**
     * @param array $bindParams
     *
     * @return $this
    */
    public function bindedParams(array $bindParams): static
    {
        $this->bindParams = array_merge($this->bindParams, $bindParams);

        return $this;
    }







    /**
     * @param array $bindValues
     *
     * @return $this
    */
    public function bindedValues(array $bindValues): static
    {
        $this->bindValues = array_merge($this->bindValues, $bindValues);

        return $this;
    }






    /**
     * @param array $bindColumns
     *
     * @return $this
    */
    public function bindedColumns(array $bindColumns): static
    {
         $this->bindColumns = array_merge($this->bindColumns, $bindColumns);

         return $this;
    }





    /**
     * @param array $parameters
     *
     * @return $this
    */
    public function queryParameters(array $parameters): static
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function logExecutedQuery(string $sql): static
    {
        $this->log[] = [
            'sql'           => $sql,
            'parameters'    => $this->parameters,
            'bindingParams' => $this->bindParams,
            'bindingValues' => $this->bindValues,
            'bindColumns'   => $this->bindColumns
        ];

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function logErrorQuery(string $sql, Throwable $e): mixed
    {
         $exception = new QueryException($sql, $e->getMessage(),  $e);
         $exception->setParameters([
             'parameters'    => $this->parameters,
             'bindingParams' => $this->bindParams,
             'bindingValues' => $this->bindValues,
             'bindColumns'   => $this->bindColumns
         ]);

         throw $exception;
    }
}