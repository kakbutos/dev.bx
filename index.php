<?php

require_once __DIR__ . '/boot.php';

/** @var array $config */
/** @var array $genres */
/** @var array $movies */

echo view('views/layout', [
	'config' => $config,
	'genres' => $genres,
	'movies' => $movies,
	'currentPage' => getFileName(__FILE__),
	'content' => view('views/components/cards', [
		'config' => $config,
		'movies' => getMoviesByLink($_GET['genre'], $_GET['search'], $movies),
	])
]);