<?php

require_once __DIR__ . '/boot.php';

/** @var array $genres */
/** @var array $movies */

$sortedMovies = [];
$getGenre = $_GET['genre'];
$getSearch = $_GET['search'];

if (isset($getGenre))
{
	$sortedMovies = getMoviesByGenre($getGenre, $movies, $genres);
}
elseif (isset($getSearch))
{
	$sortedMovies = searchFilmByName($getSearch, $movies);
}
else
{
	$sortedMovies = $movies;
}

echo view('views/layout', [
	'genres' => $genres,
	'content' => view('views/components/cards', [
		'movies' => $sortedMovies,
	])
]);