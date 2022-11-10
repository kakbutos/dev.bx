<?php

function getMoviesByGenre($genre, array $movies): array
{
	if (!isset($genre))
	{
		return $movies;
	}

	$moviesByGenre = [];

	foreach ($movies as $movie)
	{
		if (in_array($genre, $movie['genres'], true))
		{
			$moviesByGenre[] = $movie;
		}
	}

	return $moviesByGenre;
}

function getMovieById(int $id, array $movies): array
{
	foreach ($movies as $movie)
	{
		if ((int)$movie['id'] === $id)
		{
			return $movie;
		}
	}

	return [];
}

function createRatingSquares(int $key, int $rating): string
{
	if ($key > floor($rating))
	{
		return '<div class="rating-square rating-square-white"></div>';
	}
	else
	{
		return '<div class="rating-square rating-square-orange"></div>';
	}
}

function searchFilmByName($searchValue, array $movies): array
{
	if (!isset($searchValue))
	{
		return $movies;
	}

	$moviesByName = [];

	foreach ($movies as $movie)
	{
		if (mb_strtoupper(removeSpaces($movie['title'])) === mb_strtoupper(removeSpaces($searchValue)))
		{
			$moviesByName[] = $movie;
		}
	}

	return $moviesByName;
}

function getMoviesByLink($genre, $search, $movies): array
{
	if (isset($genre))
	{
		return getMoviesByGenre($genre, $movies);
	}

	if (isset($search))
	{
		return searchFilmByName($search, $movies);
	}

	return $movies;
}