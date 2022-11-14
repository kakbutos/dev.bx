<?php
declare(strict_types=1);
require_once __DIR__ . '/boot.php';

/** @var array $genres */
/** @var array $movies */

$getId = $_GET['id'];
$sortedMovie = [];

if (isset($getId))
{
	$sortedMovie = getMovieById($_GET['id'], $movies);
}

echo view('views/layout', [
	'genres' => $genres,
	'content' => view('views/components/detail', [
		'movie' => $sortedMovie,
	])
]);