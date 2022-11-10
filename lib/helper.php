<?php

function getFileName($path): string
{
	return basename($path, ".php");
}

function formatText(array $array): string
{
	return implode(", ", $array);
}

function removeSpaces(string $str): string
{
	return str_replace(' ', '', $str);
}