<?php
declare(strict_types=1);

function outputMoviesList(array $movies, $age) {
	$isCorrectAge = checkCorrectAge($age);

	if ($isCorrectAge) {
		foreach ($movies as $key => $movie) {
			if ((int) $age >= (int) $movie["age_restriction"]) {
				printMovie($key,
						   $movie["title"],
						   $movie["release_year"],
						   $movie["age_restriction"],
						   $movie["rating"]
				);
			}
		}
	}
	else {
		echo 'Wrong age!';
	}
}