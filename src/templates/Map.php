<?php namespace _templates;

use GenericClass;
use Svz\Generic\Contracts\Collection as CollectionInterface;

class Map extends Collection implements \IteratorAggregate, \ArrayAccess, \Countable, CollectionInterface
{
	/**
	 * @param GenericClass $elem
	 */
	public function add(GenericClass $elem)
	{
		throw new \BadMethodCallException();
	}

	/**
	 * @param GenericClass $elem
	 */
	public function put($offset, GenericClass $value)
	{
		$this->list[$offset] = $value;
	}

	/**
	 * @param GenericClass[] $list
	 */
	public function addAll($list)
	{
		foreach ($list as $key => $elem) {
			$this->put($key, $elem);
		}
	}
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
