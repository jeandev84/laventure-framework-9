<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;

class ObjectMetadata
{


     /**
      * @var \ReflectionObject
     */
     protected \ReflectionObject $reflection;



     /**
      * @param object $object
     */
     public function __construct(object $object)
     {

     }
}