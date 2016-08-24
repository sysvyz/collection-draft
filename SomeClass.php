<?php

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 23.08.16
 * Time: 04:08
 */
class SomeClass
{

	/**
	 * @var SomeClass
	 */
	private $parent;

	/**
	 * SomeClass constructor.
	 * @param SomeClass $parent
	 */
	public function __construct(SomeClass $parent=null)
	{
		$this->parent = $parent;
	}

	/**
	 * @return SomeClass
	 */
	public function getParent(): SomeClass
	{
		return $this->parent;
	}

	/**
	 * @param SomeClass $parent
	 */
	public function setParent(SomeClass $parent)
	{
		$this->parent = $parent;
	}




}