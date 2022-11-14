<?php

function formatText(array $array): string
{
	return implode(", ", $array);
}

function removeSpaces(string $str): string
{
	return str_replace(' ', '', $str);
}

function removeElArray(array $array, int $count)
{
	if (count($array) > $count)
	{
		for ($key = $count - 1; $key < count($array); $key++)
		{
			unset($array[$key]);
		}
	}

	return $array;
}