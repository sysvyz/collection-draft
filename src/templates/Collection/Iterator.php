<?php namespace _templates\Collection;
use GenericClass;


class Iterator extends \RecursiveArrayIterator
{
	/**
	 * @return GenericClass
	 */
	public function current()
	{
		return parent::current();
	}


}