<?php namespace Svz\Generic;
if (!defined('Svz\Generic\AUTOLOAD_VENDOR')) {
	define('Svz\Generic\AUTOLOAD_VENDOR', true);
}
if (!defined('Svz\Generic\AUTOLOAD_PREPEND')) {
	define('Svz\Generic\AUTOLOAD_PREPEND', false);
}
if (!defined('Svz\Generic\PERSIST_FILES')) {
	define('Svz\Generic\PERSIST_FILES', true);
}
/**
 * @param $class
 */
function create($base,$template){
	$factory = new \Svz\Generic\GenericFactory();
	$path = $factory->create($base,$template);
	/** @noinspection PhpIncludeInspection */
	include_once $path;

	if (!PERSIST_FILES) {
		static $fs = null;
		if (!$fs) {
			$fs = new \Symfony\Component\Filesystem\Filesystem();
		}
		$fs->remove($path);
	}
}

function autoload($class)
{


	$parts = explode("\\", $class);
	$last = array_pop($parts);
	$base = implode('\\', $parts);
	if ($last === 'Collection' && class_exists($base)) {
		create($base,'Collection');
	}
}
if (AUTOLOAD_VENDOR) {
	include_once __DIR__ . '/vendor/autoload.php';
}
spl_autoload_register('\Svz\Generic\autoload', true, AUTOLOAD_PREPEND);