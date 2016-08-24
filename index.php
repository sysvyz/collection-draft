<?php include __DIR__."/vendor/autoload.php";
//interface CollectionInterface extends  \ArrayAccess, IteratorAggregate, \Countable{
//
//}
//abstract class AbstractCollection implements CollectionInterface
//{
//
//	private $arr = [];
//
//	/**
//	 * @var callable
//	 */
//	private $K;
//	/**
//	 * @var callable
//	 */
//	private $V;
//
//	/**
//	 * AbstractCollection constructor.
//	 * @param callable $checker
//	 */
//	public function __construct(callable $K,callable $V)
//	{
//		$this->K = $K;
//		$this->V = $V;
//	}
//
//
//	/**
//	 * Retrieve an external iterator
//	 * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
//	 * @return Traversable An instance of an object implementing <b>Iterator</b> or
//	 * <b>Traversable</b>
//	 * @since 5.0.0
//	 */
//	public function getIterator()
//	{
//		return new ArrayIterator($this->arr);
//	}
//
//	/**
//	 * Whether a offset exists
//	 * @link http://php.net/manual/en/arrayaccess.offsetexists.php
//	 * @param mixed $offset <p>
//	 * An offset to check for.
//	 * </p>
//	 * @return boolean true on success or false on failure.
//	 * </p>
//	 * <p>
//	 * The return value will be casted to boolean if non-boolean was returned.
//	 * @since 5.0.0
//	 */
//	public function offsetExists($offset)
//	{
//		return isset($this->arr);
//	}
//
//	/**
//	 * Offset to retrieve
//	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
//	 * @param mixed $offset <p>
//	 * The offset to retrieve.
//	 * </p>
//	 * @return mixed Can return all value types.
//	 * @since 5.0.0
//	 */
//	public function offsetGet($offset)
//	{
//		return $this->arr[$offset];
//	}
//
//	/**
//	 * Offset to set
//	 * @link http://php.net/manual/en/arrayaccess.offsetset.php
//	 * @param mixed $offset <p>
//	 * The offset to assign the value to.
//	 * </p>
//	 * @param mixed $value <p>
//	 * The value to set.
//	 * </p>
//	 * @return void
//	 * @since 5.0.0
//	 */
//	public function offsetSet($offset, $value)
//	{
//		$v = $this->V;
//		 $this->arr[$offset]=$v($value);	}
//
//	/**
//	 * Offset to unset
//	 * @link http://php.net/manual/en/arrayaccess.offsetunset.php
//	 * @param mixed $offset <p>
//	 * The offset to unset.
//	 * </p>
//	 * @return void
//	 * @since 5.0.0
//	 */
//	public function offsetUnset($offset)
//	{
//		unset($this->arr);
//	}
//
//	/**
//	 * Count elements of an object
//	 * @link http://php.net/manual/en/countable.count.php
//	 * @return int The custom count as an integer.
//	 * </p>
//	 * <p>
//	 * The return value is cast to an integer.
//	 * @since 5.1.0
//	 */
//	public function count()
//	{
//		return count($this->arr);
//	}
//
//
//}
//class A{
//
//}
//class B{
//
//}
//class Collection extends AbstractCollection{
//
//	public function put(string $offset, A $value){
//
//	}
//}
//
//$c = new Collection(function ($s){return $s;},function (A $s){return $s;});
//$c['s']=new A();
//
//
//use PhpParser\BuilderFactory;
//use PhpParser\PrettyPrinter;
//use PhpParser\Node;
//
//$factory = new BuilderFactory;
//$node = $factory->namespace('Name\Space')
//	->addStmt($factory->use('Some\Other\Thingy')->as('SomeOtherClass'))
//	->addStmt($factory->class('SomeClass')
//		->extend('SomeOtherClass')
//		->implement('A\Few', '\Interfaces')
//		->makeAbstract() // ->makeFinal()
//
//		->addStmt($factory->method('someMethod')
//			->makePublic()
//			->makeAbstract() // ->makeFinal()
//			->setReturnType('bool')
//			->addParam($factory->param('someParam')->setTypeHint('SomeClass'))
//			->setDocComment('/**
//                              * This method does something.
//                              *
//                              * @param SomeClass And takes a parameter
//                              */')
//		)
//
//		->addStmt($factory->method('anotherMethod')
//			->makeProtected() // ->makePublic() [default], ->makePrivate()
//			->addParam($factory->param('someParam')->setDefault('test'))
//			// it is possible to add manually created nodes
//			->addStmt(new Node\Expr\Print_(new Node\Expr\Variable('someParam')))
//			->addStmt(new Node\Expr\Assign(new PhpParser\Node\Expr\Variable('x'),new PhpParser\Node\Expr\Variable('y')))
//			->addStmt(new PhpParser\Node\Expr\AssignOp\Concat(new PhpParser\Node\Expr\Variable('x'),new PhpParser\Node\Expr\Variable('x')))
//
//		)
//
//		// properties will be correctly reordered above the methods
//		->addStmt($factory->property('someProperty')->makeProtected())
//		->addStmt($factory->property('anotherProperty')->makePrivate()->setDefault(array(1, 2, 3)))
//	)
//
//	->getNode()
//;
//
//$stmts = array($node);
//$prettyPrinter = new PrettyPrinter\Standard();
////echo $prettyPrinter->prettyPrintFile($stmts);
//
//
//use PhpParser\ParserFactory;
//$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
//
//$ast = $parser->parse(file_get_contents(__DIR__.'/SomeClass.php'));
//
//print_r($ast);

use PhpParser\ParserFactory;
use Svz\Generic\GenericPrinter;
use Symfony\Component\Filesystem\Filesystem;

$t1 = microtime(true);
$fs = new Filesystem();

$choose = 1;

if($choose == 0){

	$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);


	/** @var \PhpParser\Node[] $ast */
	$ast = $parser->parse(file_get_contents(__DIR__.'/SomeCollection.php'));

	$fs->dumpFile(__DIR__.'/tmp/SomeConcreteClass_Collection.ast',serialize($ast));
}else if($choose == 1){

	$ast = unserialize(file_get_contents(__DIR__.'/tmp/SomeConcreteClass_Collection.ast'));
}

$p = new GenericPrinter(\Svz\GenericTest\SomeConcreteClass::class);
$str = $p->prettyPrint($ast);

$fs->dumpFile(__DIR__.'/tmp/SomeConcreteClass_Collection.php','<?php '.$str);
include_once __DIR__.'/tmp/SomeConcreteClass_Collection.php';
//$fs->remove(__DIR__.'/tmp/SomeConcreteClass_Collection.php');
/** @noinspection PhpUndefinedNamespaceInspection */
$c = new \Collection\SomeConcreteClass_Collection();

echo (microtime(true)-$t1).PHP_EOL;