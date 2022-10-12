<?php
declare(strict_types=1);

/** @var array $movies */
require "static/moviesList.php";

require "functions/readAge.php";
require "functions/outputMoviesList.php";
require "functions/checkCorrectAge.php";
require "functions/printMovie.php";

$age = readAge();

outputMoviesList($movies, $age);