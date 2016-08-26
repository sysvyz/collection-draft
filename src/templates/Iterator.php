<?php namespace _templates;
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