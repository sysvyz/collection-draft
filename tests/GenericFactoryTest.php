<?php namespace Svz\GenericTest;

use Svz\Generic\GenericFactory;
use Svz\GenericTest\TestObject\ClassA;
use Svz\GenericTest\TestObject\ClassC;
use Svz\GenericTest\TestObject\ClassD;
use Svz\GenericTest\TestObject\ClassB as Anothername;
use Symfony\Component\Filesystem\Filesystem;

class GenericFactoryTest extends \PHPUnit_Framework_TestCase
{


    public static function _tearDownAfterClass()
    {

        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/TestObject/AbcClass/');
        $fs->remove(__DIR__ . '/TestObject/XYZClass/');
        parent::tearDownAfterClass();
    }

    public function testFactory()
    {

        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/TestObject/AbcClass/');
        $f = new GenericFactory();
        $f->create(ClassA::class);

        $a = new ClassA\Collection();


        $a->addAll([new TestObject\ClassA(2), new TestObject\ClassA(2), new TestObject\ClassA(2)]);


        $a->get(0)->xyz;

    }

    public function testAutoload()
    {
        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/TestObject/XYZClass/');

        $fs = new Filesystem();
        $a = new Anothername\Collection();

        $a[] = new Anothername(3);
        $a->add(new Anothername(2));
        $a[0] = new Anothername(4);
        $this->assertInstanceOf(Anothername\Iterator::class, $a->getIterator());
        $this->assertEquals(2, count($a));
    }

    public function testFactoryAndAutoload()
    {

        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/TestObject/AbcClass/');
        $f = new GenericFactory();
        $f->create(ClassC::class);

        $a = new ClassC\Collection\Collection();


        $row1 = new ClassC\Collection();
        $row1->addAll([new TestObject\ClassC(2), new TestObject\ClassC(2), new TestObject\ClassC(2)]);
        $row2 = new ClassC\Collection();
        $row2->addAll([new TestObject\ClassA(2), new TestObject\ClassC(2), new TestObject\ClassA(2)]);
        $a->addAll([$row1, $row2]);


        $this->assertEquals(-5, $a->get(0)->get(1)->takeFive());


    }

    public function testAutoloadAndAutoload()
    {

        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/TestObject/AbcClass/');

        $a = new ClassD\Collection\Collection();


        $row1 = new ClassD\Collection();
        $row1->addAll([new TestObject\ClassD(2), new TestObject\ClassD(3), new TestObject\ClassD(2)]);
        $row2 = new ClassD\Collection();
        $row2->addAll([new TestObject\ClassD(2), new TestObject\ClassD(2), new TestObject\ClassD(2)]);
        $a->addAll([$row1, $row2]);

        $row2 = new ClassC\Collection();

        $this->assertEquals(3, $a->get(0)->get(1)->publicField);


    }

}
