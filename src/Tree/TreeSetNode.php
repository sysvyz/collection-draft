<?php namespace Svz\Generic\Tree;


use Cofi\Comparator\Abstracts\AbstractComparator;

class TreeSetNode
{

	public $elem;
	/**
	 * @var TreeSetNode
	 */
	public $left;
	/**
	 * @var TreeSetNode
	 */
	public $right;

	/**
	 * TreeSetNode constructor.
	 * @param Comparable $elem
	 */
	public function __construct($elem)
	{
		$this->elem = $elem;
	}


	public function add(TreeSetNode $otherNode, AbstractComparator $comparator)
	{
		$cmp = $comparator($this->elem, $otherNode->elem);
		if (!$cmp) return false;
		if ($cmp > 0) {
			if (is_null($this->left)) {
				$this->left = $otherNode;
				return true;
			}
			return $this->left->add($otherNode, $comparator);
		}
		if (is_null($this->right)) {
			$this->right = $otherNode;
			return true;
		}
		return $this->right->add($otherNode, $comparator);


	}
}
