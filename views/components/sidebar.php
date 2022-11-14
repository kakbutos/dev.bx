<?php
/**
 * @var array $genres
 */

$currentPage = $_SERVER['REQUEST_URI'];
$getGenre = $_GET['genre'];

$indexPage = strripos($currentPage, 'index.php');
$favoritesPage = strripos($currentPage, 'favorites.php');

?>

<div class="sidebar">
	<a href="/index.php" class="sidebar-logo"></a>
	<div class="sidebar-menu">
		<a 	class="sidebar-item <?= $indexPage && $getGenre === null ? 'sidebar-item-active' : '' ?>"
		   	href="/index.php">
			<?= getConfig('index') ?>
		</a>

		<?php foreach ($genres as $key => $name): ?>
		<a 	class="sidebar-item <?= $getGenre === $key ? 'sidebar-item-active' : '' ?>"
		   	href="<?= "index.php" . "?genre=" . $key ?>">
			<?= $name ?>
		</a>
		<?php endforeach;?>

		<a 	class="sidebar-item <?= $favoritesPage ? 'sidebar-item-active' : '' ?>"
		   	href="/favorites.php">
			<?= getConfig('favorites') ?>
		</a>
	</div>
</div>