<?php
if(!defined('SVZ_GENERIC_AUTOLOAD_VENDOR')){
    define('SVZ_GENERIC_AUTOLOAD_VENDOR' , true);
}
if(!defined('SVZ_GENERIC_AUTOLOAD_PREPEND')){
    define('SVZ_GENERIC_AUTOLOAD_PREPEND' , false);
}

/**
 * @param $class
 */
function _generic_autoload($class)
{
	$factory = new \Svz\Generic\GenericFactory();
	$parts = explode("\\", $class);
	$last = array_pop($parts);
	$base = implode('\\', $parts);
	if ($last === 'Collection' && class_exists($base)) {

		$path = $factory->create($base);
        /** @noinspection PhpIncludeInspection */
        include_once $path;

	}
}

if(SVZ_GENERIC_AUTOLOAD_VENDOR){
    include_once __DIR__ . '/vendor/autoload.php';
}
spl_autoload_register('_generic_autoload', true, SVZ_GENERIC_AUTOLOAD_PREPEND);