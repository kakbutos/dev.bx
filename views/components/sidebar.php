<?php
/**
 * @var array $genres
 * @var array $config
 * @var string $currentPage
 */
?>

<div class="sidebar">
	<a href="/index.php" class="sidebar-logo"></a>
	<div class="sidebar-menu">
		<a 	class="sidebar-item <?= $currentPage === 'index' && $_GET['genre'] === null ? 'sidebar-item-active' : '' ?>"
		   	href="/index.php">
			<?= $config['sidebar']['index'] ?>
		</a>

		<?php foreach ($genres as $name): ?>
		<a 	class="sidebar-item <?= $_GET['genre'] === $name ? 'sidebar-item-active' : '' ?>"
		   	href="<?= "index.php" . "?genre=" . $name ?>">
			<?= $name ?>
		</a>
		<?php endforeach;?>

		<a 	class="sidebar-item <?= $currentPage === 'favorites' ? 'sidebar-item-active' : '' ?>"
		   	href="/favorites.php">
			<?= $config['sidebar']['favorites'] ?>
		</a>
	</div>
</div>