<?php

use Svz\GenericTest\TestObject\ClassA;


if (!defined('PERSIST_FILES')) {
	define('Svz\Generic\PERSIST_FILES', true);
}

include __DIR__."/autoload.php";

$c = new ClassA\Collection();