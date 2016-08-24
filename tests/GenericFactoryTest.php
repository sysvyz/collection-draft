<?php namespace Svz\GenericTest;
use Svz\Generic\GenericFactory;
use Svz\GenericTest\Imp\XYZClass;

class GenericFactoryTest extends \PHPUnit_Framework_TestCase
{

	public function testFactory()
	{


		$f = new GenericFactory();
		$f->create(AbcClass::class);

	}

	public function testAutoload()
	{
		$a = new XYZClass\Collection();

		$a[]=new XYZClass(3);
		$a->add(new XYZClass(2));
		$a[0]=new XYZClass(4);
		$this->assertInstanceOf(XYZClass\Iterator::class,$a->getIterator());
		$this->assertEquals(2,count($a));
	}


}
