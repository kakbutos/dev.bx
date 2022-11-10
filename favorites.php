<?php

require_once __DIR__ . '/boot.php';

/** @var array $config */
/** @var array $genres */

echo view('views/layout', [
	'config' => $config,
	'genres' => $genres,
	'content' => 'Страница в разработке...',
	'currentPage' => getFileName(__FILE__),
]);