<?php

function getGenresList(): array
{
	$connection = getDbConnection();

	$result = mysqli_query($connection, "select CODE, NAME from genre");

	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$genres = [];
	$resultList = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$genres[] = $row;
	}

	foreach ($genres as $value)
	{
		$resultList[$value['CODE']] = $value['NAME'];
	}

	return $resultList;
}

function getMovieById(int $id): array
{
	if ($id < 1)
	{
		return [];
	}

	$connection = getDbConnection();

	$actors = getActorsByFilmId($connection, $id);

	$result = mysqli_query($connection,
		"SELECT  m.ID,
					   m.TITLE,
					   m.ORIGINAL_TITLE,
					   m.DESCRIPTION,
					   m.DURATION,
					   GROUP_CONCAT(g.NAME SEPARATOR ', ') AS `GENRES`,
					   d.NAME as `DIRECTOR`,
					   m.AGE_RESTRICTION,
					   m.RELEASE_DATE,
					   m.RATING
				FROM movie m
				INNER JOIN director d on m.DIRECTOR_ID = d.ID
				INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
				INNER JOIN genre g on mg.GENRE_ID = g.ID
				WHERE m.ID = '{$id}'");

	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$movie = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$movie[] = [
			'id' => $row['ID'],
			'title' => $row['TITLE'],
			'original-title' => $row['ORIGINAL_TITLE'],
			'description' => $row['DESCRIPTION'],
			'duration' => $row['DURATION'],
			'genres' => $row['GENRES'],
			'director' => $row['DIRECTOR'],
			'age-restriction' => $row['AGE_RESTRICTION'],
			'release-date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING'],
			'cast' => $actors
		];
	}

	return $movie;
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

function getActorsByFilmId($connection, int $id): string
{
	$result = mysqli_query($connection,
					"SELECT a.NAME FROM movie_actor ma
						   INNER JOIN actor a on ma.ACTOR_ID = a.ID
						   WHERE ma.MOVIE_ID = '{$id}'");

	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$actors = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$actors[] = $row['NAME'];
	}

	return implode(', ', $actors);
}

function getMoviesByParams(string $genre = null, string $searchNameFilm = null): array
{
	$connection = getDbConnection();

	$genreHaving = null;
	$searchNameFilmWhere = null;

	if (isset($genre))
	{
		$genre = mysqli_escape_string($connection, $genre);

		$genreHaving = "HAVING GENRE_CODE like '%{$genre}%'";
	}

	if (isset($searchNameFilm))
	{
		$searchNameFilm = mysqli_escape_string($connection, $searchNameFilm);

		$searchNameFilmWhere = "WHERE m.TITLE like '%{$searchNameFilm}%'";
	}

	$result = mysqli_query($connection,
		"SELECT  m.ID,
					   m.TITLE,
					   m.ORIGINAL_TITLE,
					   m.DESCRIPTION,
					   m.DURATION,
					   GROUP_CONCAT(g.NAME SEPARATOR ', ') AS `GENRES`,
					   GROUP_CONCAT(g.CODE SEPARATOR ', ') AS `GENRE_CODE`,
					   d.NAME as `DIRECTOR`,
					   m.AGE_RESTRICTION,
					   m.RELEASE_DATE,
					   m.RATING
				FROM movie m
				INNER JOIN director d on m.DIRECTOR_ID = d.ID
				INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
				INNER JOIN genre g on mg.GENRE_ID = g.ID
				{$searchNameFilmWhere}
				GROUP BY m.ID
				{$genreHaving}");

	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$movies = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$movies[] = [
			'id' => $row['ID'],
			'title' => $row['TITLE'],
			'original-title' => $row['ORIGINAL_TITLE'],
			'description' => $row['DESCRIPTION'],
			'duration' => $row['DURATION'],
			'genres' => $row['GENRES'],
			'director' => $row['DIRECTOR'],
			'age-restriction' => $row['AGE_RESTRICTION'],
			'release-date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING']
		];
	}

	return $movies;
};