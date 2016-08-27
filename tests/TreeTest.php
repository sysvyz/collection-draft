<?php namespace Svz\GenericTest;

namespace TestObject;

use Cofi\Comparator\Abstracts\AbstractComparator;
use Cofi\Comparator\ComparatorFunction;
use Svz\GenericTest\GenericTestCase;
use Svz\GenericTest\TestObject\ClassG as Element;
use Symfony\Component\Filesystem\Filesystem;


class TreeTest extends GenericTestCase
{


	public function testTree()
	{
		$tree = new Element\TreeSet();


		$tree->add(new Element(1, 'bob'));
		$tree->add(new Element(2, 'john'));
		$tree->add(new Element(3, 'frank'));
		$tree->add(new Element(46, 'ronald'));
		$tree->add(new Element(22, 'mario'));
		$tree->add(new Element(21, 'jane'));
		$tree->add(new Element(45, 'cara'));
		$tree->add(new Element(295, 'june'));
		$tree->add(new Element(476, 'mathilda'));
		$tree->add(new Element(22, 'sepp'));
		$tree->add(new Element(22, 'bob'));

		$this->assertCount(9, $tree);
	}

	public function testTreeComparator()
	{
		$tree = new Element\TreeSet(new ElemComp());


		$tree->add(new Element(1, 'bob'));
		$tree->add(new Element(2, 'john'));
		$tree->add(new Element(3, 'frank'));
		$tree->add(new Element(46, 'ronald'));
		$tree->add(new Element(22, 'mario'));
		$tree->add(new Element(21, 'jane'));
		$tree->add(new Element(45, 'cara'));
		$tree->add(new Element(295, 'june'));
		$tree->add(new Element(1, 'bob'));
		$tree->add(new Element(22, 'sepp'));
		$tree->add(new Element(22, 'bob'));

		$this->assertCount(10, $tree);
	}

	public function testTreeComparator2()
	{
		$tree = new Element\TreeSet(new ElemCompName());


		$tree->add(new Element(1, 'bob'));
		$tree->add(new Element(2, 'john'));
		$tree->add(new Element(3, 'frank'));
		$tree->add(new Element(46, 'ronald'));
		$tree->add(new Element(22, 'mario'));
		$tree[] = (new Element(21, 'jane'));
		$tree->add(new Element(45, 'cara'));
		$tree->add(new Element(295, 'june'));
		$tree->add(new Element(1, 'bob'));
		$tree->add(new Element(22, 'sepp'));
		$tree->add(new Element(22, 'bob'));

		$this->assertCount(9, $tree);
	}

	public function testTreeIterator()
	{
		$tree = new Element\TreeSet(new ElemCompName());


		$tree->add(new Element(1, 'bob'));
		$tree->add(new Element(2, 'john'));
		$tree->add(new Element(3, 'frank'));
		$tree->add(new Element(46, 'ronald'));
		$tree[] = (new Element(22, 'mario'));
		$tree->add(new Element(21, 'jane'));
		$tree->add(new Element(45, 'cara'));
		$tree->add(new Element(295, 'june'));
		$tree->add(new Element(476, 'mathilda'));
		$tree->add(new Element(22, 'sepp'));
		$tree->add(new Element(22, 'bob'));

//		/** @var Element $element */
//		foreach ($tree as $element) {
//			echo $element->getName() . ': ' . $element->getValue() . PHP_EOL;
//		}
	}

	public function testTreeMap()
	{
		$map = new Element\TreeSet\Map(new ElemCompName());

		$list = [
			new Element(1, 'bob'),
			new Element(2, 'john'),
			new Element(3, 'mathilda'),
			new Element(2, 'bob'),
			new Element(3, 'mathilda'),
			new Element(1, 'john'),
			new Element(3, 'bob'),
			new Element(2, 'john'),
			new Element(1, 'mathilda'),
			new Element(2, 'mathilda'),
			new Element(3, 'bob'),
		];

		/** @var Element $element */
		foreach ($list as $element) {
			if(!isset($map[$element->getName()])){
				$map[$element->getName()]=[];
			}
			$map[$element->getName()]->add($element);
		}
//		foreach ($map as $tree) {
//			foreach ($tree as $element) {
//				echo $element->getName() . ': ' . $element->getValue() . PHP_EOL;
//			}
//			echo PHP_EOL;
//		}
	}
}

class ElemComp extends AbstractComparator
{

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		return $this->_compare($a, $b);
	}

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function _compare(Element $a, Element $b)
	{
		$c = ComparatorFunction::number();
		$cmp = $c($a->getValue(), $b->getValue());
		$s = ComparatorFunction::string();
		return $cmp ? $cmp : $s($a->getName(), $b->getName());


	}
}

class ElemCompName extends ElemComp
{

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function _compare(Element $a, Element $b)
	{
		$s = ComparatorFunction::string();
		return $s($a->getName(), $b->getName());


	}
}