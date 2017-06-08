<?php

$psrAutoloader = function ($prefix, $path, $stripPrefix = true) {
	$prefix = rtrim($prefix, '\\') . '\\';
	$path = rtrim($path, '/\\') . DS;

	return function ($class) use ($prefix, $path, $stripPrefix) {
	    if (substr($class, 0, strlen($prefix)) !== $prefix) {
			return;
	    }

	    if ($stripPrefix) {
			$class = substr($class, strlen($prefix));
	    }

	    $source = $path . str_replace('\\', DS, $class) . '.php';
	    if (is_file($source)) {
			require($source);
	    }
	};
};

$vendorsDir = dirname(__DIR__) . DS . 'vendors' . DS;
$yamlDir = $vendorsDir . 'symfony' . DS . 'yaml';

spl_autoload_register($psrAutoloader('Symfony\\Component\\Yaml', $yamlDir));
