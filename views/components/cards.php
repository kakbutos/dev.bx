<?php
/**
 * @var $movies
 */
?>

<div class="card-wrapper">
	<?php if (empty($movies)):?>
		<?= getConfig('notFoundMovie', 'Такого фильма нет') ?>
	<?php endif; ?>
	<?php foreach ($movies as $movie): ?>
	<div class="card">
		<div class="card-img" style="background-image: url('../../assets/images/<?= $movie['id'] ?>.jpg')"></div>
		<div class="card-text-container">
			<div class="card-title"><?= $movie['title'] . " ({$movie['release-date']})" ?></div>
			<div class="card-title-translate"><?= $movie['original-title'] ?></div>
			<div class="card-desc"><?= truncate($movie['description'], 250) ?></div>
			<div class="card-length-genre-wrapper">
				<div class="card-length-wrapper">
					<div class="card-clock"></div>
					<div class="card-length">
						<?= $movie['duration'] . " мин. / " . date('h:i', mktime(0, $movie['duration'])) ?>
					</div>
				</div>
				<div class="card-genre"><?= trimWords($movie['genres'], 2) ?></div>
			</div>
		</div>
		<div class="card-overlay-wrapper">
			<div class="card-overlay"></div>
			<a 	href="<?= 'detail.php' . '?id=' . $movie['id'] ?>"
				class="card-detail-btn">
				<?= getConfig('detail') ?>
			</a>
		</div>
	</div>
	<?php endforeach;?>
</div>