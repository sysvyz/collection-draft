<?php namespace Svz\GenericTest;

use Svz\Generic\GenericFactory;
use Svz\GenericTest\TestObject\ClassA;
use Svz\GenericTest\TestObject\ClassC;
use Svz\GenericTest\TestObject\ClassD;
use Svz\GenericTest\TestObject\ClassB as Anothername;
use Symfony\Component\Filesystem\Filesystem;

class GenericFactoryTest extends \PHPUnit_Framework_TestCase
{


    public static function setUpBeforeClass(){
        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/TestObject/ClassA/');
        $fs->remove(__DIR__ . '/TestObject/ClassB/');
        $fs->remove(__DIR__ . '/TestObject/ClassC/');
        $fs->remove(__DIR__ . '/TestObject/ClassD/');
        parent::setUpBeforeClass();
    }
    public static function tearDownAfterClass()
    {

        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/TestObject/ClassA/');
        $fs->remove(__DIR__ . '/TestObject/ClassB/');
        $fs->remove(__DIR__ . '/TestObject/ClassC/');
        $fs->remove(__DIR__ . '/TestObject/ClassD/');
        parent::tearDownAfterClass();
    }

    public function testFactory()
    {

        $f = new GenericFactory();
        $f->create(ClassA::class,GenericFactory::COLLECTION);

        $a = new ClassA\Collection();


        $a->addAll([new TestObject\ClassA(2), new TestObject\ClassA(2), new TestObject\ClassA(2)]);



        $this->assertEquals(2,   $a->get(0)->xyz);
    }

    public function testAutoload()
    {

        $a = new Anothername\Collection();

        $a[] = new Anothername(3);
        $a->add(new Anothername(2));
        $a[0] = new Anothername(4);
        $this->assertInstanceOf(Anothername\Iterator::class, $a->getIterator());
        $this->assertEquals(2, count($a));
    }

    public function testFactoryAndAutoload()
    {

        $f = new GenericFactory();
        $f->create(ClassC::class,GenericFactory::COLLECTION);

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

        $a = new ClassD\Collection\Collection();


        $row1 = new ClassD\Collection();
        $row1->addAll([new TestObject\ClassD(2), new TestObject\ClassD(3), new TestObject\ClassD(2)]);
        $row2 = new ClassD\Collection();
        $row2->addAll([new TestObject\ClassD(2), new TestObject\ClassD(2), new TestObject\ClassD(2)]);
        $a->addAll([$row1, $row2]);

        $this->assertEquals(3, $a->get(0)->get(1)->publicField);


    }

    public function testMultiDim()
    {
        $a = new ClassD\Collection\Collection();


        $row1 = new ClassD\Collection();
        $row1->addAll([new TestObject\ClassD(2), new TestObject\ClassD(3), new TestObject\ClassD(2)]);
        $row2 = new ClassD\Collection();
        $row2->addAll([new TestObject\ClassD(2), new TestObject\ClassD(2), new TestObject\ClassD(2)]);
        $a->addAll([$row1, $row2]);


        $this->assertEquals(3, $a[0][1]->publicField);
        $this->assertEquals(2, $a[0][2]->publicField);
        $this->assertEquals(2, $a[1][1]->publicField);


    }

	public function testMultiDim2()
	{


		$a = new ClassD\Collection\Collection();


		$a[] = new TestObject\ClassD\Collection();
		$a[] = new ClassD\Collection();

		$a[0][] = new ClassD(2);
		$a[0][4] = new ClassD(1);
		$a[1][0] = new ClassD(3);
		$a[0][5] = new ClassD(2);
		$a[1][1] = new ClassD(6);
		$a[0][2] = new ClassD(8);
		$a[0][] = new ClassD(9);
		$a[] = [new ClassD(1),new ClassD(2),new ClassD(3)];


		$this->assertEquals(2, $a[0][0]->publicField);
		$this->assertEquals(1, $a[0][4]->publicField);
		$this->assertEquals(6, $a[1][1]->publicField);
		$this->assertEquals(9, $a[0][6]->publicField);


	}
	public function testMultiDim3()
	{


		$a = new ClassD\Collection\Collection();


		$a->addAll([[],[],[],[],[],[],[],[]]);

		print_r($a);

		$a[0][] = new ClassD(2);
		$a[0][4] = new ClassD(1);
		$a[1][0] = new ClassD(3);
		$a[0][5] = new ClassD(2);
		$a[1][1] = new ClassD(6);
		$a[0][2] = new ClassD(8);
		$a[0][] = new ClassD(9);
		$a[] = [new ClassD(1),new ClassD(2),new ClassD(3)];


		$this->assertEquals(2, $a[0][0]->publicField);
		$this->assertEquals(1, $a[0][4]->publicField);
		$this->assertEquals(6, $a[1][1]->publicField);
		$this->assertEquals(9, $a[0][6]->publicField);

		$a[0][6]->publicField = 22;

		$this->assertEquals(22, $a[0][6]->publicField);



	}



}
