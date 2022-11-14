<?php

require_once __DIR__ . '/boot.php';

/** @var array $genres */

echo view('views/layout', [
	'genres' => $genres,
	'content' => 'Страница в разработке...',
]);