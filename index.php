<?php

require_once __DIR__ . '/boot.php';

/** @var array $genres */
/** @var array $movies */

if (isset($_GET['genre']))
{
	$movies = getMoviesByGenre($_GET['genre'], $movies, $genres);
}

if (isset($_GET['search']))
{
	$movies = searchFilmByName($_GET['search'], $movies);
}

echo view('views/layout', [
	'genres' => $genres,
	'content' => view('views/components/cards', [
		'movies' => $movies,
	])
]);