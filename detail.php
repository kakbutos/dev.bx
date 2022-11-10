<?php

require_once __DIR__ . '/boot.php';

/** @var array $config */
/** @var array $genres */
/** @var array $movies */

echo view('views/layout', [
	'config' => $config,
	'genres' => $genres,
	'content' => view('views/components/detail', [
		'config' => $config,
		'movie' => getMovieById($_GET['id'], $movies)
	]),
	'currentPage' => getFileName(__FILE__),
]);