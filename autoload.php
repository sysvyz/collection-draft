<?php


function _generic_autoload($class)
{
	echo $class . PHP_EOL;
	$factory = new \Svz\Generic\GenericFactory();
	$parts = explode("\\", $class);
	$last = array_pop($parts);
	$base = implode('\\', $parts);
	if ($last === 'Collection' && class_exists($base)) {

		$path = $factory->create($base);
		include_once $path;

	}
}

include_once __DIR__ . '/vendor/autoload.php';
spl_autoload_register('_generic_autoload', true, false);