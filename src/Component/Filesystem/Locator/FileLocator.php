<?php
namespace Laventure\Component\Filesystem\Locator;


/**
 * @inheritDoc
*/
class FileLocator implements FileLocatorInterface
{


    /**
     * @var string
    */
    protected string $root;



    /**
     * FileLoader constructor.
     *
     * @param string $resource
    */
    public function __construct(string $resource)
    {
        $this->basePath($resource);
    }




    /**
     * @param string $resource
     *
     * @return $this
    */
    public function basePath(string $resource): static
    {
        $resource = rtrim($resource, DIRECTORY_SEPARATOR);

        $this->root = $resource;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function locate(string $path): string
    {
        return join(DIRECTORY_SEPARATOR, [realpath($this->root), $this->normalizePath($path)]);
    }






    /**
     * @param string $pattern
     *
     * @return array
    */
    public function resources(string $pattern): array
    {
        if(! $files = glob($this->locate($pattern))) {
             return [];
        }

        return $files;
    }






    /**
     * @param string $path
     *
     * @return string
    */
    public function normalizePath(string $path): string
    {
        return str_replace(["\\", "/"], DIRECTORY_SEPARATOR, trim($path, '\\/'));
    }
}