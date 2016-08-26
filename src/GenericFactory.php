<?php namespace Svz\Generic;

use PhpParser\ParserFactory;

class GenericFactory
{
	const COLLECTION = "Collection";
	const ITERATOR = "Iterator";
	const ABSTRACT_COLLECTION = "AbstractCollection";


	private $path;

	/**
	 * GenericFactory constructor.
	 * @param $path
	 */
	public function __construct($path = null)
	{
		$this->path = $path;
	}

	public function create($fullQualifiedName, $template)
	{
		$parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
		$p = new \Svz\Generic\GenericPrinter($fullQualifiedName);
		$r = new \ReflectionClass($fullQualifiedName);
		$isCollection = $r->implementsInterface(Contracts\Collection::class);
		if ($isCollection && in_array($template,[self::COLLECTION,self::ITERATOR])) {
			$ast = $parser->parse(file_get_contents(__DIR__ . '/templates/Collection/' . $template . '.php'));
		} else {
			$ast = $parser->parse(file_get_contents(__DIR__ . '/templates/' . $template . '.php'));
		}


		$fs = new \Symfony\Component\Filesystem\Filesystem();

		$str = $p->prettyPrintFile($ast);
		if ($this->path) {
			$filename = $this->path . '/' . $p->getClassName() . '_Collection.php';
			$fs->dumpFile($filename, '<?php ' . $str);
		} else {

			$filename = dirname($r->getFileName()) . '/' . $p->getClassName() . '/' . $template . '.php';

			$fs->dumpFile($filename, $str);
		}
		return $filename;
	}

}