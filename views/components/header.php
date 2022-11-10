<?php
/**
 * @var array $config
 */
?>

<div class="header">
	<div class="header-search">
		<div class="header-search-logo"></div>
		<form action="/index.php" method="get" class="header-form">
			<input class="header-search-input"
				   name="search"
				   type="text"
				   placeholder="<?= $config['searchCatalog'] ?>"
			>
			<button type="submit" class="header-search-btn small-btn"><?= $config['search'] ?></button>
		</form>
	</div>
	<a href="/add-film.php" class="header-add-film-btn small-btn"><?= $config['addFilm'] ?></a>
</div>