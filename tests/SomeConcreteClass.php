<?php namespace Svz\GenericTest;


interface SomeInterface
{

}
class SomeConcreteClass implements SomeInterface
{
	public $val;

	/**
	 * SomeConcreteClass constructor.
	 * @param $val
	 */
	public function __construct($val)
	{
		$this->val = $val;
	}

}
class SomeConcreteClassExtension extends SomeConcreteClass
{
	public $val;

	/**
	 * SomeConcreteClass constructor.
	 * @param $val
	 */
	public function __construct($val)
	{
		$this->val = $val;
	}

}