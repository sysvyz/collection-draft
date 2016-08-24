<?php namespace Svz\GenericTest\TestObject;

class ClassA extends ClassC
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

}