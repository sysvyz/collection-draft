<?php namespace Svz\Generic\Tree;
use Svz\Generic\Tree\TreeSetNode;

use GenericClass;
class TreeSetIterator implements \Iterator
{
	private $counter;
	/**
	 * @var TreeSetNode
	 */
	private $root;
	/**
	 * @var TreeSetNode[]
	 */
	private $stack = [];
	/**
	 * @var TreeSetNode
	 */
	private $current;

	/**
	 * TreeIterator constructor.
	 * @param TreeSetNode $root
	 */
	public function __construct(TreeSetNode $root)
	{
		$this->root = $root;
		$this->current = $this->root;
		$this->_findLeft();
	}

	private function _push(TreeSetNode $node)
	{
		array_push($this->stack, $node);
	}

	private function _pop()
	{
		return array_pop($this->stack);
	}

	private function _findLeft()
	{
		while ($this->current->left) {
			$this->_push($this->current);
			$this->current = $this->current->left;
		}
	}

	private function _findRight()
	{
		if ($this->current->right) {
			$this->current = $this->current->right;
			$this->_findLeft();
		}else{
			$this->current = $this->_pop();
		}

	}

	/**
	 * Return the current element
	 * @link http://php.net/manual/en/iterator.current.php
	 * @return GenericClass Can return any type.
	 * @since 5.0.0
	 */
	public function current()
	{
		return $this->current->elem;
	}

	/**
	 * Move forward to next element
	 * @link http://php.net/manual/en/iterator.next.php
	 * @return void Any returned value is ignored.
	 * @since 5.0.0
	 */
	public function next()
	{
 		$this->_findRight();
		$this->counter++;

	}

	/**
	 * Return the key of the current element
	 * @link http://php.net/manual/en/iterator.key.php
	 * @return mixed scalar on success, or null on failure.
	 * @since 5.0.0
	 */
	public function key()
	{
		return $this->counter;
	}

	/**
	 * Checks if current position is valid
	 * @link http://php.net/manual/en/iterator.valid.php
	 * @return boolean The return value will be casted to boolean and then evaluated.
	 * Returns true on success or false on failure.
	 * @since 5.0.0
	 */
	public function valid()
	{
		return !is_null($this->current);
	}

	/**
	 * Rewind the Iterator to the first element
	 * @link http://php.net/manual/en/iterator.rewind.php
	 * @return void Any returned value is ignored.
	 * @since 5.0.0
	 */
	public function rewind()
	{
		// TODO: Implement rewind() method.
	}

}