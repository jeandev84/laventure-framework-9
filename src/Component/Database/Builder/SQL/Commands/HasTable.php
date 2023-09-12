<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;

use RuntimeException;

trait HasTable
{


    /**
     * @var string
     */
    protected string $table;





    /**
     * @var string
    */
    protected string $alias;





    /**
     * @param string $table
     *
     * @param string $alias
     *
     * @return $this
    */
    public function table(string $table, string $alias = ''): static
    {
        $this->table  = $table;
        $this->alias  = $alias;

        return $this;
    }





    /**
     * @return string
    */
    public function getTable(): string
    {
        if (! $this->table) {
            throw new RuntimeException("unable table name in: ". get_called_class());
        }

        return $this->table;
    }





    /**
     * @return string
    */
    public function getTableAlias(): string
    {
        return $this->alias;
    }
}