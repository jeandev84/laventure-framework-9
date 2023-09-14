<?php
namespace Laventure\Component\Database\ORM\Persistence;

use Laventure\Component\Database\ORM\Collection\ArrayCollection;
use Laventure\Component\Database\ORM\Collection\Collection;
use Laventure\Component\Database\ORM\Collection\ObjectStorage;


/**
 * @PersistenceCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence
*/
class PersistenceCollection extends ObjectStorage
{

     /**
      * @param Collection $collection
     */
     public function __construct(protected Collection $collection)
     {
     }
}