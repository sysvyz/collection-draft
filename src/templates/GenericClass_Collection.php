<?php namespace _Placeholder;

use GenericClass;

class Collection implements \IteratorAggregate, \ArrayAccess, \Countable
{

	/**
	 * @var GenericClass[]
	 */
	private $list = [];

	/**
	 * SomeClass_Collection constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * @param GenericClass $elem
	 */
	public function add(GenericClass $elem)
	{
		$this->list[] = $elem;
	}

	/**
	 * @param GenericClass $elem
	 */
	private function put($offset, GenericClass $value)
	{
		$this->list[$offset] = $value;
	}

	/**
	 * @param GenericClass[] $list
	 */
	public function addAll($list)
	{
		foreach ($list as $elem) {
			$this->add($elem);
		}
	}

	/**
	 * @param $index
	 * @return GenericClass
	 */
	public function get($index)
	{
		if (isset($this->list[$index])) {
			return $this->list[$index];
		}
		throw new \OutOfBoundsException($index . ' not set');
	}

	/**
	 * @param int $index
	 * @return bool
	 */
	public function remove($index)
	{
		if (isset($this->list[$index])) {

			unset($this->list[$index]);

			$this->list = array_values($this->list);

			return true;
		}
		return false;
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
		$iterator = (false) ? null : new Iterator($this->list);
		return $iterator;
	}

	/**
	 * Whether a offset exists
	 * @link http://php.net/manual/en/arrayaccess.offsetexists.php
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 * @return boolean true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 * @since 5.0.0
	 */
	public function offsetExists($offset)
	{
		return isset($this->list[$offset]);
	}

	/**
	 * Offset to retrieve
	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 * @return GenericClass Can return all value types.
	 * @since 5.0.0
	 */
	public function offsetGet($offset)
	{
		return $this->list[$offset];
	}

	/**
	 * Offset to set
	 * @link http://php.net/manual/en/arrayaccess.offsetset.php
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetSet($offset, $value)
	{

		$this->put($offset, $value);

	}

	/**
	 * Offset to unset
	 * @link http://php.net/manual/en/arrayaccess.offsetunset.php
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetUnset($offset)
	{
		unset($this->list[$offset]);
	}

	/**
	 * Count elements of an object
	 * @link http://php.net/manual/en/countable.count.php
	 * @return int The custom count as an integer.
	 * </p>
	 * <p>
	 * The return value is cast to an integer.
	 * @since 5.1.0
	 */
	public function count()
	{
		return count($this->list);
	}
}

class Iterator extends \ArrayIterator
{
	/**
	 * @return GenericClass
	 */
	public function current()
	{
		parent::current();
	}


}