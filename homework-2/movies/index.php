<?php
declare(strict_types=1);

/** @var array $movies */
require "static/moviesList.php";

require "functions/getMoviesListFunctions.php";

$age = readAge();

outputMoviesListByAge($movies, $age);