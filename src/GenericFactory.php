<?php namespace Svz\Generic;

use Illuminate\Filesystem\Filesystem;
use PhpParser\ParserFactory;

class GenericFactory
{
	const ABSTRACT_COLLECTION = "AbstractCollection";
	const COLLECTION = "Collection";
	const MAP = "Map";
	const TREE_SET = "TreeSet";

	const TREE_SET_ITERATOR = "TreeSetIterator";
	const ITERATOR = "Iterator";

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
		$ast = $this->_buildAst($template, $r, $parser);


		$fs = new Filesystem();

		$str = $p->prettyPrintFile($ast);
		if ($this->path) {
			$filename = $this->path . '/' . $p->getClassName() . '_Collection.php';
			$fs->put($filename, '<?php ' . $str);
		} else {
			$dirname = dirname($r->getFileName()) . '/' . $p->getClassName();
			if (!$fs->exists($dirname)) {
				$fs->makeDirectory($dirname);

			}
			$filename = $dirname . '/' . $template . '.php';

			$fs->put($filename, $str);

		}
		return $filename;
	}

	/**
	 * @param $template
	 * @param $r
	 * @param $parser
	 * @return mixed
	 */
	private function _buildAst($template, $r, $parser)
	{
		$isCollection = $r->implementsInterface(Contracts\Collection::class);
		if ($isCollection && in_array($template, [self::COLLECTION])) {
			$ast = $parser->parse(file_get_contents(__DIR__ . '/templates/Collection/' . $template . '.php'));
			return $ast;
		} else if (in_array($template, [self::TREE_SET, self::TREE_SET_ITERATOR])) {
			$ast = $parser->parse(file_get_contents(__DIR__ . '/templates/Tree/' . $template . '.php'));
			return $ast;
		} else {
			$ast = $parser->parse(file_get_contents(__DIR__ . '/templates/' . $template . '.php'));
			return $ast;
		}
	}

}