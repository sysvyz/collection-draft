<?php namespace Svz\Generic\Tree;


use Cofi\Comparator\Interfaces\ComparatorInterface;
use Svz\Generic\Comparator\ComparableComparator;
use Svz\Generic\Contracts\Collection as CollectionInterface;
use Svz\Generic\Contracts\Comparable;
use Svz\Generic\Tree\TreeSetNode;
use GenericClass;

class TreeSet extends AbstractCollection implements \IteratorAggregate, \ArrayAccess, \Countable, CollectionInterface
{
	/**
	 * @var TreeSetNode
	 */
	private $root;
	/**
	 * @var int
	 */
	private $count = 0;
	/**
	 * @var ComparatorInterface
	 */
	private $comparator;

	/**
	 * TreeSet constructor.
	 * @param ComparatorInterface $comparator
	 * @internal param ComparatorInterface $comperatorcomparator
	 */
	public function __construct(ComparatorInterface $comparator = null)
	{
		if (is_null($comparator)) {
			$comparator = new ComparableComparator();
		}
		$this->comparator = $comparator;
	}


	/**
	 * @param GenericClass $elem
	 * @return bool
	 */
	public function add(GenericClass $elem)
	{
		$node = new TreeSetNode($elem);
		if ($this->root) {
			if (!$this->root->add($node, $this->comparator)) {
				return false;
			}
		} else {
			$this->root = $node;

		}
		$this->count++;
		return true;
	}

	/**
	 * Retrieve an external iterator
	 * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
	 * @return \Traversable An instance of an object implementing <b>Iterator</b> or
	 * <b>Traversable</b>
	 * @since 5.0.0
	 */
	public function getIterator()
	{
		return new TreeSetIterator($this->root);
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
		throw new MethodNotFoundException('offsetExists');
	}

	/**
	 * Offset to retrieve
	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 * @return mixed Can return all value types.
	 * @since 5.0.0
	 */
	public function offsetGet($offset)
	{
		throw new MethodNotFoundException('offsetExists');
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
		if(!is_null($offset)){
			throw new MethodNotFoundException('offsetExists');
		}
		$this->add($value);
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
		throw new MethodNotFoundException('offsetExists');
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
		return $this->count;
	}
}
