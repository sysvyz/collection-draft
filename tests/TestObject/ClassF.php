<?php namespace Svz\GenericTest\TestObject;



use Svz\Generic\Contracts\Comparable;

class ClassF implements Comparable
{
	private $value;

	/**
	 * ClassE constructor.
	 * @param $value
	 */
	public function __construct($value)
	{
		$this->value = $value;
	}


	public function compare($other)
	{

		return strcmp($this->value,$other->value);
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

}
class ClassFA extends ClassF{

}