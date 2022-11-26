<?php

require_once __DIR__ . '/boot.php';

$genres = getGenresList();

echo view('views/layout', [
	'genres' => $genres,
	'content' => 'Страница "Избранное" в разработке...',
]);