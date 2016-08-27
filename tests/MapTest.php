<?php namespace Svz\GenericTest;

namespace TestObject;

use Svz\GenericTest\GenericTestCase;
use Svz\GenericTest\TestObject\ClassF;
use Symfony\Component\Filesystem\Filesystem;

class MapTest extends GenericTestCase
{

	public function testMap()
	{
		$map = new ClassF\Map();


		$map->put('a', new ClassF('bob'));
		$map->put('b', new ClassF('john'));
		$map->put('f', new ClassF('frank'));
		$map->put('d', new ClassF('ronald'));
		$map->put('s', new ClassF('mario'));
		$map->put('q', new ClassF('jane'));
		$map->put('w', new ClassF('cara'));
		$map->put('e', new ClassF('june'));
		$map->put('r', new ClassF('mathilda'));
		$map->put('t', new ClassF('sepp'));
		$map->put('u', new ClassF('bob'));

		$this->assertCount(11, $map);
		$iterator = $map->getIterator();
		while ($iterator->valid()) {
//			echo $iterator->key().': '.$iterator->current()->getValue();
//			echo PHP_EOL;
			$iterator->next();
		}
	}

}