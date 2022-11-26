<?php
/**
 * @var array $movie
 */
?>

<?php foreach ($movie as $value): ?>
	<div class="movie-detail">
		<div class="movie-title-wrapper">
			<div class="movie-title"><?= $value['title'] . " ({$value['release-date']})" ?></div>
			<div class="movie-favorites">
				<svg viewBox="0 0 51 51" xmlns="http://www.w3.org/2000/svg">
					<path d="M25.5115 42.625L25.4999 44.625L25.4883 42.625C25.4719 42.6251 25.4556 42.622 25.4404 42.6158C25.4257 42.6098 25.4123 42.601 25.4009 42.59C25.4004 42.5896 25.4 42.5892 25.3996 42.5888L8.90146 26.0694C8.90042 26.0684 8.89939 26.0673 8.89836 26.0663C7.19978 24.3483 6.24707 22.0298 6.24707 19.6138C6.24707 17.1985 7.1992 14.8806 8.89681 13.1628C10.6088 11.4582 12.9263 10.501 15.3424 10.501C17.7605 10.501 20.0799 11.4597 21.7922 13.167C21.7924 13.1671 21.7925 13.1673 21.7927 13.1675L24.0857 15.4605L25.4999 16.8747L26.9141 15.4605L29.2071 13.1675C29.2073 13.1672 29.2076 13.167 29.2078 13.1668C30.9201 11.4597 33.2394 10.501 35.6574 10.501C38.0735 10.501 40.3911 11.4582 42.103 13.1628C43.8006 14.8806 44.7528 17.1985 44.7528 19.6138C44.7528 22.0299 43.8 24.3485 42.1013 26.0665C42.1003 26.0675 42.0993 26.0684 42.0984 26.0694L25.6002 42.5888C25.5998 42.5892 25.5994 42.5896 25.599 42.59C25.5875 42.601 25.5741 42.6098 25.5595 42.6158C25.5442 42.622 25.5279 42.6251 25.5115 42.625Z" fill="currentColor" color="currentColor" stroke-width="4"/>
				</svg>
			</div>
		</div>
		<div class="movie-age-wrapper">
			<div class="movie-original-title"><?= $value['original-title'] ?></div>
			<div class="movie-age"><?= $value['age-restriction'] . "+" ?></div>
		</div>
		<div class="movie-detail-content">
			<div class="movie-img" style="background-image: url('../../assets/images/<?= $value['id'] ?>.jpg');"></div>
			<div class="movie-detail-info">
				<div class="movie-rating">
					<?php for ($key = 1; $key <= 10; $key++): ?>
						<?= createRatingSquares($key, $value['rating']) ?>
					<?php endfor; ?>
					<div class="rating-circle"><?= $value['rating'] ?></div>
				</div>
				<div class="movie-about-title detail-text-title"><?= getConfig('about') ?></div>
				<div class="movie-about-wrapper">
					<div class="movie-about-name-wrapper">
						<div class="movie-about-name detail-text-s-gray"><?= getConfig('productionYear') ?></div>
						<div class="movie-about-name detail-text-s-gray"><?= getConfig('producer') ?></div>
						<div class="movie-about-name detail-text-s-gray"><?= getConfig('starring') ?></div>
					</div>
					<div class="movie-about-desc-wrapper">
						<div class="movie-about-desc detail-text-s-black"><?= $value['release-date'] ?></div>
						<div class="movie-about-desc detail-text-s-black"><?= $value['director'] ?></div>
						<div class="movie-about-desc detail-text-s-black"><?= $value['cast'] ?></div>
					</div>
				</div>
				<div class="movie-desc-title detail-text-title"><?= getConfig('description') ?></div>
				<div class="movie-desc-text"><?= $value['description'] ?></div>
			</div>
		</div>
	</div>
<?php endforeach;?>