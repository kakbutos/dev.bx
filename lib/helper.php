<?php

function formatText(string $string, int $count): string
{
	$array = explode(', ', $string);
	$array = array_slice($array, 0, $count);

	return implode(', ', $array);
}