<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping\Factory;

use Laventure\Component\Database\ORM\Persistence\Mapping\ClassMetadataInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\ObjectMetadataInterface;


/**
 * @MetadataFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping\Factory
*/
interface MetadataFactoryInterface
{
    /**
     * @param string $classname
     *
     * @return ClassMetadataInterface
    */
    public function createFromClass(string $classname): ClassMetadataInterface;




    /**
     * @param object $object
     *
     * @return ObjectMetadataInterface
    */
    public function createFromObject(object $object): ObjectMetadataInterface;
}