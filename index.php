<?php

require_once __DIR__ . '/boot.php';

$movies = getMoviesByParams();
$genres = getGenresList();

if (isset($_GET['genre']))
{
	$movies = getMoviesByParams($_GET['genre']);
}

if (isset($_GET['search']))
{
	$movies = getMoviesByParams(null, $_GET['search']);
}

echo view('views/layout', [
	'genres' => $genres,
	'content' => view('views/components/cards', [
		'movies' => $movies,
	])
]);