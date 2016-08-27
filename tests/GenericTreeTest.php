<?php
use Svz\GenericTest\TestObject\ClassA;
use Svz\GenericTest\TestObject\ClassE;
use Symfony\Component\Filesystem\Filesystem;

class GenericTreeTest extends \Svz\GenericTest\GenericTestCase
{


	public function testFactory()
	{


		$a = new ClassA\TreeSet();


		$a->addAll([new ClassA(2), new ClassA(2), new ClassA(2)]);

		$this->assertCount(1, $a);

	}

	public function testTreeSet()
	{


		$a = new ClassA\TreeSet();

		$list = [
			new ClassA('asd'),
			new ClassA('asf'),
			new ClassA('ssa'),
			new ClassA('asa'),
			new ClassA('ssg'),
			new ClassA('sea')
		];
		$expected = [
			'asa',
			'asd',
			'asf',
			'sea',
			'ssa',
			'ssg',
		];

		$a->addAll($list);

		$this->assertCount(6, $a);
		$c = 0;
		/** @var ClassA $obj */
		foreach ($a as $obj) {
			$this->assertEquals($expected[$c++], $obj->xyz);
		}
	}
	public function testTreeSet_Collection()
	{


		$a = new ClassE\TreeSet\Collection();

		$list = [
			[
				new ClassE('fds'),
				new ClassE('sfdg'),
				new ClassE('ffdgd'),
				new ClassE('assdff'),
				new ClassE('gseasda'),
				new ClassE('fsgdf'),
			], [
				new ClassE('sfgd'),
				new ClassE('sewsf'),
				new ClassE('dsfd'),
				new ClassE('asa'),
				new ClassE('sdfg'),
				new ClassE('jgfsea'),
			], [
				new ClassE('sfd'),
				new ClassE('fgsg'),
				new ClassE('sdfads'),
				new ClassE('dsfdfs'),
				new ClassE('sdfgfds'),
				new ClassE('sgd'),
			], [
				new ClassE('dfsgfds'),
				new ClassE('ssg'),
				new ClassE('asf'),
				new ClassE('sdfgs'),
				new ClassE('aretgsd'),
				new ClassE('sffdg'),
			]
		];
		$a->addAll($list);

//		foreach ($a as $tree) {
//			/** @var \TestObject\ClassE $obj */
//			foreach ($tree as $obj) {
//				echo $obj->getValue().PHP_EOL;
//			}
//			echo PHP_EOL;
//		}
	}
}