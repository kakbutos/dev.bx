<?php

require_once __DIR__ . '/boot.php';

$movies = getMoviesList();
$genres = getGenresList();

if (isset($_GET['genre']))
{
	$movies = getMoviesByGenre($_GET['genre']);
}

if (isset($_GET['search']))
{
	$movies = searchFilmByName($_GET['search']);
}

echo view('views/layout', [
	'genres' => $genres,
	'content' => view('views/components/cards', [
		'movies' => $movies,
	])
]);