<?php
declare(strict_types=1);
require_once __DIR__ . '/boot.php';

/** @var array $genres */
/** @var array $movies */

$movie = isset($_GET['id']) ? getMovieById($_GET['id'], $movies) : [];

echo view('views/layout', [
	'genres' => $genres,
	'content' => view('views/components/detail', [
		'movie' => $movie,
	])
]);