<?php

function getMoviesList(): array
{
	$connection = getDbConnection();

	$result = mysqli_query($connection,
					"SELECT  m.ID,
								   m.TITLE,
								   m.ORIGINAL_TITLE,
								   m.DESCRIPTION,
								   m.DURATION,
								   GROUP_CONCAT(g.NAME SEPARATOR ', ') AS `GENRES`,
								   castTable.CAST,
								   d.NAME as `DIRECTOR`,
								   m.AGE_RESTRICTION,
								   m.RELEASE_DATE,
								   m.RATING
							FROM movie m
							INNER JOIN director d on m.DIRECTOR_ID = d.ID
							INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
							INNER JOIN genre g on mg.GENRE_ID = g.ID
							INNER JOIN 
							(
								SELECT ma.MOVIE_ID as `maMovieID`, GROUP_CONCAT(a.NAME SEPARATOR ', ') as `CAST`
								FROM movie_actor ma
								INNER JOIN actor a on ma.ACTOR_ID = a.ID
								GROUP BY ma.MOVIE_ID
							) castTable on castTable.maMovieID = m.ID
							GROUP BY m.ID");

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
			'cast' => $row['CAST'],
			'director' => $row['DIRECTOR'],
			'age-restriction' => $row['AGE_RESTRICTION'],
			'release-date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING']
		];
	}

	return $movies;
}

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

function getMoviesByGenre($genre): array
{
	$connection = getDbConnection();

	$genre = mysqli_escape_string($connection, $genre);

	$result = mysqli_query($connection,
		"SELECT  m.ID,
					   m.TITLE,
					   m.ORIGINAL_TITLE,
					   m.DESCRIPTION,
					   m.DURATION,
					   GROUP_CONCAT(g.NAME SEPARATOR ', ') AS `GENRES`,
					   GROUP_CONCAT(g.CODE SEPARATOR ', ') AS `GENRE_CODE`,
					   castTable.CAST,
					   d.NAME as `DIRECTOR`,
					   m.AGE_RESTRICTION,
					   m.RELEASE_DATE,
					   m.RATING
				FROM movie m
				INNER JOIN director d on m.DIRECTOR_ID = d.ID
				INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
				INNER JOIN genre g on mg.GENRE_ID = g.ID
				INNER JOIN 
				(
					SELECT ma.MOVIE_ID as `maMovieID`, GROUP_CONCAT(a.NAME SEPARATOR ', ') as `CAST`
					FROM movie_actor ma
					INNER JOIN actor a on ma.ACTOR_ID = a.ID
					GROUP BY ma.MOVIE_ID
				) castTable on castTable.maMovieID = m.ID
				GROUP BY m.ID
				HAVING GENRE_CODE like '%{$genre}%'");

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
			'cast' => $row['CAST'],
			'director' => $row['DIRECTOR'],
			'age-restriction' => $row['AGE_RESTRICTION'],
			'release-date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING']
		];
	}

	return $movies;
}

function getMovieById($id): array
{
	$connection = getDbConnection();

	$id = mysqli_escape_string($connection, $id);

	$result = mysqli_query($connection,
		"SELECT  m.ID,
					   m.TITLE,
					   m.ORIGINAL_TITLE,
					   m.DESCRIPTION,
					   m.DURATION,
					   GROUP_CONCAT(g.NAME SEPARATOR ', ') AS `GENRES`,
					   castTable.CAST,
					   d.NAME as `DIRECTOR`,
					   m.AGE_RESTRICTION,
					   m.RELEASE_DATE,
					   m.RATING
				FROM movie m
				INNER JOIN director d on m.DIRECTOR_ID = d.ID
				INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
				INNER JOIN genre g on mg.GENRE_ID = g.ID
				INNER JOIN 
				(
					SELECT ma.MOVIE_ID as `maMovieID`, GROUP_CONCAT(a.NAME SEPARATOR ', ') as `CAST`
					FROM movie_actor ma
					INNER JOIN actor a on ma.ACTOR_ID = a.ID
					GROUP BY ma.MOVIE_ID
				) castTable on castTable.maMovieID = m.ID
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
			'cast' => $row['CAST'],
			'director' => $row['DIRECTOR'],
			'age-restriction' => $row['AGE_RESTRICTION'],
			'release-date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING']
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

function searchFilmByName($searchNameFilm): array
{
	$connection = getDbConnection();

	$searchNameFilm = mysqli_escape_string($connection, $searchNameFilm);

	$result = mysqli_query($connection,
		"	SELECT  m.ID,
						m.TITLE,
						m.ORIGINAL_TITLE,
						m.DESCRIPTION,
						m.DURATION,
						GROUP_CONCAT(g.NAME SEPARATOR ', ') AS `GENRES`,
						castTable.CAST,
						d.NAME as `DIRECTOR`,
						m.AGE_RESTRICTION,
						m.RELEASE_DATE,
						m.RATING
				FROM movie m
						 INNER JOIN director d on m.DIRECTOR_ID = d.ID
						 INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
						 INNER JOIN genre g on mg.GENRE_ID = g.ID
						 INNER JOIN
				(
					SELECT ma.MOVIE_ID as `maMovieID`, GROUP_CONCAT(a.NAME SEPARATOR ', ') as `CAST`
						 FROM movie_actor ma
								  INNER JOIN actor a on ma.ACTOR_ID = a.ID
						 GROUP BY ma.MOVIE_ID
					 ) castTable on castTable.maMovieID = m.ID
				WHERE m.TITLE like '%{$searchNameFilm}%'
				GROUP BY m.ID");

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
			'cast' => $row['CAST'],
			'director' => $row['DIRECTOR'],
			'age-restriction' => $row['AGE_RESTRICTION'],
			'release-date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING']
		];
	}

	return $movie;
}