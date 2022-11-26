<?php

function getConfig(string $name, $defaultValue = null)
{
	static $config = null;

	if ($config === null)
	{
		$masterConfig = require ROOT . '/config.php';
		if (file_exists(ROOT . '/config.local.php'))
		{
			$localConfig = require ROOT . '/config.local.php';
		}
		else
		{
			$localConfig = [];
		}

		$config = array_merge($masterConfig, $localConfig);
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