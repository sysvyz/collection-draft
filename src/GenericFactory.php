<?php namespace Svz\Generic;

use PhpParser\ParserFactory;

class GenericFactory
{
	private $path;

	/**
	 * GenericFactory constructor.
	 * @param $path
	 */
	public function __construct($path = null)
	{
		$this->path = $path;
	}

	public function create($fullQualifiedName)
	{
		$parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);

		$ast = $parser->parse(file_get_contents(__DIR__ . '/../GenericClass_Collection.php'));


		$fs = new \Symfony\Component\Filesystem\Filesystem();

		$p = new \Svz\Generic\GenericPrinter($fullQualifiedName);
		$str = $p->prettyPrint($ast);
		if ($this->path) {
			$filename = $this->path . '/' . $p->getClassName() . '_Collection.php';
			$fs->dumpFile($filename, '<?php ' . $str);
		} else {
			$r = new \ReflectionClass('\\' . $p->getFullQualifiedName());
			$filename = dirname($r->getFileName()) . '/' . $p->getClassName() . '/Collection.php';

			$fs->dumpFile($filename, '<?php ' . $str);
		}
		return $filename;
	}

	public function load($path = null)
	{

	}
	public function loadAndDismiss($path = null)
	{

	}

}