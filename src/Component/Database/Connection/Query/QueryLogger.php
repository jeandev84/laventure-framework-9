<?php
namespace Laventure\Component\Database\Connection\Query;

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
     * @param array $bindParams
     *
     * @return $this
    */
    public function logBindParams(array $bindParams): static
    {
        $this->bindParams = array_merge($this->bindParams, $bindParams);

        return $this;
    }







    /**
     * @param array $bindValues
     *
     * @return $this
    */
    public function logBindValues(array $bindValues): static
    {
        $this->bindValues = array_merge($this->bindValues, $bindValues);

        return $this;
    }
}