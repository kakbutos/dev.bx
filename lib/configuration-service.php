<?php

function getConfig(string $name, $defaultValue = null)
{
	static $config = null;

	if ($config === null)
	{
		$config = require ROOT . '/config.php';
	}

	if (array_key_exists($name, $config))
	{
		return $config[$name];
	}

	if ($defaultValue !== null)
	{
		return $defaultValue;
	}

	throw new Exception("Configuration option {$name} not found");
}