<?php namespace Svz\GenericTest\TestObject;



use Svz\Generic\Contracts\Comparable;



class ClassG implements Comparable
{

	private $value;
	private $name;

	/**
	 * Element constructor.
	 * @param $value
	 * @param $name
	 */
	public function __construct($value, $name)
	{
		$this->value = $value;
		$this->name = $name;
	}


	public function compare($other)
	{
		if ($other instanceof ClassG)
			return $this->value - $other->value;
		throw new \Exception("excpected: " . ClassG::class);
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

}