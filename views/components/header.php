<div class="header">
	<div class="header-search">
		<div class="header-search-logo"></div>
		<form action="/index.php" method="get" class="header-form">
			<input class="header-search-input"
				   name="search"
				   type="text"
				   placeholder="<?= getConfig('searchCatalog') ?>"
			>
			<button type="submit" class="header-search-btn small-btn"><?= getConfig('search') ?></button>
		</form>
	</div>
	<a href="/add-film.php" class="header-add-film-btn small-btn"><?= getConfig('addFilm') ?></a>
</div>