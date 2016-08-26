<?php namespace _templates\Collection;

use GenericClass;
use Svz\Generic\Contracts\CollectionCollection as CollectionInterface;

class Collection extends AbstractCollection implements \IteratorAggregate, \ArrayAccess, \Countable, CollectionInterface
{


	/**
	 * @param GenericClass $elem
	 */
	public function add(GenericClass $elem)
	{
		parent::add($elem);
	}

	/**
	 *
	 * @param int $offset
	 * @param GenericClass $elem
	 */
	public function put($offset, GenericClass $value)
	{

		parent::put($offset, $value);
	}

	/**
	 * @param GenericClass[] $list
	 */
	public function addAll($list)
	{
		foreach ($list as $elem) {
			if (is_array($elem)) {
				$arr = $this->_buildGenericCollection();
				$arr->addAll($elem);
				$elem = $arr;
			}
			$this->add($elem);

		}
	}

	/**
	 * @param $index
	 * @return GenericClass
	 */
	public function get($index)
	{

		return parent::get($index);
	}

	/**
	 * @param int $index
	 * @return bool
	 */
	public function remove($index)
	{
		return parent::remove($index);
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


	private function _buildGenericCollection()
	{
		return new GenericClass();
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
		if (is_array($value)) {
			$arr = $this->_buildGenericCollection();
			$arr->addAll($value);
			$value = $arr;
		}
		if (is_null($offset)) {
			$this->add($value);
		} else {
			$this->put($offset, $value);
		}
	}
}
