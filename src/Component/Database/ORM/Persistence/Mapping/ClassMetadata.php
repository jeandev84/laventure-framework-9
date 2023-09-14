<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;



use Laventure\Component\Database\ORM\Persistence\Mapping\Exception\MetadataException;
use ReflectionClass;

/**
 * @inheritdoc
*/
class ClassMetadata implements ClassMetadataInterface
{


    /**
     * @var ReflectionClass
    */
    protected ReflectionClass $reflection;




    /**
     * @var string|null
    */
    protected ?string $identifier = 'id';




    /**
     * @var string
    */
    protected string $table = '';





    /**
     * @param string $classname
    */
    public function __construct(string $classname)
    {
        try {
            $this->reflection = new ReflectionClass($classname);
        } catch (\Exception $e) {
             throw new MetadataException($e->getMessage(), $e->getCode());
        }
    }





    /**
     * @param string $table
     *
     * @return $this
    */
    public function table(string $table): static
    {
         $this->table = $table;

         return $this;
    }




    /**
     * @param string $column
     *
     * @return $this
    */
    public function identifier(string $column): static
    {
        $this->identifier = $column;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getClassname(): string
    {
        return $this->reflection->getName();
    }






    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
         if (! $this->table) {
             $shortName   =  $this->reflection->getShortName();
             $this->table = mb_strtolower("{$shortName}s");
         }

         return $this->table;
    }





    /**
     * @inheritDoc
    */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }








    /**
     * @inheritDoc
    */
    public function getReflection(): ReflectionClass
    {
         return $this->reflection;
    }







    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
         return array_map(function (\ReflectionMethod $method) {
               return $method->getName();
         }, $this->reflection->getMethods());
    }








    /**
     * @inheritDoc
    */
    public function hasMethod(string $name): bool
    {
        return in_array($name, $this->getMethods());
    }
}