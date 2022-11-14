<?php
/**
 * @var array $genres
 * @var $content
*/
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../reset.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="../views/css/header.css">
	<link rel="stylesheet" href="../views/css/sidebar.css">
	<link rel="stylesheet" href="../views/css/cards.css">
	<link rel="stylesheet" href="../views/css/detail.css">
	<title><?= getConfig('title'); ?></title>
</head>
<body>

<div class="container">
	<?= view('views/components/sidebar', [
		'genres' => $genres,
	]) ?>
	<div class="wrapper">
		<?= view('views/components/header') ?>
		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>

</body>
</html>