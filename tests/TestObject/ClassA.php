<?php namespace Svz\GenericTest\TestObject;

use Svz\Generic\Contracts\Comparable;

class ClassA extends ClassC implements Comparable
{
	public $xyz;

	/**
	 * AbcClass constructor.
	 * @param $xyz
	 */
	public function __construct($xyz)
	{
		$this->xyz = $xyz;
	}


	public function compare($other)
	{
		return strcmp($this->xyz,$other->xyz);
	}
}