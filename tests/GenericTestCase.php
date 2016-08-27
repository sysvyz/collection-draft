<?php namespace Svz\GenericTest;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.08.16
 * Time: 23:31
 */
class GenericTestCase extends \PHPUnit_Framework_TestCase
{
	public static function setUpBeforeClass()
	{
		$fs = new Filesystem();
		$fs->remove(__DIR__ . '/TestObject/ClassA/');
		$fs->remove(__DIR__ . '/TestObject/ClassB/');
		$fs->remove(__DIR__ . '/TestObject/ClassC/');
		$fs->remove(__DIR__ . '/TestObject/ClassD/');
		$fs->remove(__DIR__ . '/TestObject/ClassE/');
		$fs->remove(__DIR__ . '/TestObject/ClassF/');
		parent::setUpBeforeClass();
	}

	public static function tearDownAfterClass()
	{

		$fs = new Filesystem();
		$fs->remove(__DIR__ . '/TestObject/ClassA/');
		$fs->remove(__DIR__ . '/TestObject/ClassB/');
		$fs->remove(__DIR__ . '/TestObject/ClassC/');
		$fs->remove(__DIR__ . '/TestObject/ClassD/');
		$fs->remove(__DIR__ . '/TestObject/ClassE/');
		$fs->remove(__DIR__ . '/TestObject/ClassF/');
		parent::tearDownAfterClass();
	}
}