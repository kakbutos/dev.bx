<?php

declare(strict_types=1);

require_once __DIR__ . '/boot.php';

$genres = getGenresList();

$movie = isset($_GET['id']) ? getMovieById((int)$_GET['id']) : [];

echo view('views/layout', [
	'genres' => $genres,
	'content' => view('views/components/detail', [
		'movie' => $movie,
	])
]);