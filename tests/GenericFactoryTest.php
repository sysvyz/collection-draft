<?php namespace Svz\GenericTest;

use Svz\Generic\GenericFactory;
use Svz\GenericTest\Imp\AbcClass;
use Svz\GenericTest\Imp\XYZClass as Anothername;
use Symfony\Component\Filesystem\Filesystem;

class GenericFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function setUp()
    {

        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/Imp/AbcClass/');
        $fs->remove(__DIR__ . '/Imp/XYZClass/');
        parent::setUpBeforeClass();
    }

    public function _tearDown()
    {

        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/Imp/AbcClass/');
        $fs->remove(__DIR__ . '/Imp/XYZClass/');
        parent::tearDownAfterClass();
    }

    public function testFactory()
    {


        $f = new GenericFactory();
        $f->create(AbcClass::class);

        $a = new AbcClass\Collection();
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


}
