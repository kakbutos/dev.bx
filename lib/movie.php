<?php

function getMoviesByGenre($genre, array $movies, array $genres): array
{
	$moviesByGenre = [];

	if (!isset($genre))
	{
		return $movies;
	}

	$genreName = getGenreName($genres, $genre);

	foreach ($movies as $movie)
	{
		if (in_array($genreName, $movie['genres'], true))
		{
			$moviesByGenre[] = $movie;
		}
	}

	return $moviesByGenre;
}

function getMovieById($id, array $movies): array
{
	foreach ($movies as $movie)
	{
		if ((int)$movie['id'] === (int)$id)
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
		if (strripos($movie['title'], $searchValue) !== false)
		{
			$moviesByName[] = $movie;
		}
	}

	return $moviesByName;
}

function getGenreName(array $genres, string $idGenre)
{
	foreach ($genres as $key => $genreName)
	{
		if ($key === $idGenre)
		{
			return $genreName;
		}
	}

	return '';
}