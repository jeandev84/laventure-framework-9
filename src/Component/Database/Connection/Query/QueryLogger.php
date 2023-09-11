<?php
namespace Laventure\Component\Database\Connection\Query;

use Laventure\Component\Database\Connection\Exception\QueryException;

/**
 * @QueryLogger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query
*/
class QueryLogger
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
    public function addBindParams(array $bindParams): static
    {
        $this->bindParams = array_merge($this->bindParams, $bindParams);

        return $this;
    }







    /**
     * @param array $bindValues
     *
     * @return $this
    */
    public function addBindValues(array $bindValues): static
    {
        $this->bindValues = array_merge($this->bindValues, $bindValues);

        return $this;
    }





    /**
     * @param array $parameters
     *
     * @return $this
    */
    public function addQueryParameters(array $parameters): static
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
    }





    /**
     * @param string $sql
     *
     * @return $this
    */
    public function logExcecutedQuery(string $sql): static
    {
        $this->log[] = [
           'sql'           => $sql,
           'parameters'    => $this->parameters,
           'bindingParams' => $this->bindParams,
           'bindingValues' => $this->bindValues,
        ];

        return $this;
    }





    /**
     * @param string $sql
     *
     * @param \Throwable $e
     *
     * @return void
    */
    public function logErrorQuery(string $sql, \Throwable $e): void
    {
         $this->log[] = [
             'sql' => $sql,
             'parameters'    => $this->parameters,
             'bindingParams' => $this->bindParams,
             'bindingValues' => $this->bindValues,
             'code'          => $e->getCode(),
             'message'       => $e->getMessage(),
             'trace'         => $e->getTrace(),
             'file'          => $e->getFile(),
             'line'          => $e->getLine(),
             'traceAsString' => $e->getTraceAsString(),
             'previous'      => $e->getPrevious()
         ];

         throw new QueryException($e->getMessage(), $e->getCode(), $e);
    }




    /**
     * @return array
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }




    /**
     * @return array
     */
    public function getBindParams(): array
    {
        return $this->bindParams;
    }




    /**
     * @return array
    */
    public function getBindValues(): array
    {
        return $this->bindValues;
    }





    /**
     * @return array
    */
    public function getInfo(): array
    {
        return $this->log;
    }
}