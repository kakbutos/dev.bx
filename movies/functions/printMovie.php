<?php
declare(strict_types=1);

function printMovie(int $key, string $title, int $release_year, int $age_restriction, float $rating) {
	echo $key + 1
		. ". {$title} "
		. "({$release_year}), "
		. "{$age_restriction}+."
		. " Rating - {$rating}"
		. "\n";
}