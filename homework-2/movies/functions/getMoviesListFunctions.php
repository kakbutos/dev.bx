<?php
declare(strict_types = 1);

function readAge()
{
	echo 'Enter your age: ';

	return readline();
}

function checkCorrectAge($age): bool
{
	return (is_numeric($age) && (int)$age >= 0 && (int)$age < 150);
}

function outputMoviesListByAge(array $movies, $age)
{
	$isCorrectAge = checkCorrectAge($age);

	if (!$isCorrectAge) {
		echo 'Wrong age!';

		return;
	}

	$preparedMoviesList = prepareMoviesListByAge($movies, (int)$age);

	outputMoviesList($preparedMoviesList);
}

function prepareMoviesListByAge(array $movies, int $age): array
{
	$preparedMovieList = [];

	foreach ($movies as $movie)
	{
		if ($age >= (int)$movie["age_restriction"])
		{
			$preparedMovieList[] = $movie;
		}
	}

	return $preparedMovieList;
}

function outputMoviesList(array $movies)
{
	$movieNumber = 1;

	foreach ($movies as $movie)
	{
		printMovie($movieNumber,
			$movie["title"],
			$movie["release_year"],
			$movie["age_restriction"],
			$movie["rating"]
		);
		$movieNumber++;
	}
}

function printMovie(int $movieNumber, string $title, int $release_year, int $age_restriction, float $rating)
{
	echo $movieNumber
		. ". {$title} "
		. "({$release_year}), "
		. "{$age_restriction}+."
		. " Rating - {$rating}"
		. "\n";
}