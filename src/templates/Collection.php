<?php namespace _templates;

use GenericClass;
use Svz\Generic\Contracts\Collection as CollectionInterface;

class Collection extends AbstractCollection implements \IteratorAggregate, \ArrayAccess, \Countable, CollectionInterface
{

	/**
	 * Retrieve an external iterator
	 * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
	 * @return Iterator An instance of an object implementing <b>Iterator</b> or
	 * <b>Traversable</b>
	 * @since 5.0.0
	 */
	public function getIterator()
	{
		return new Iterator($this->list);
	}
}
