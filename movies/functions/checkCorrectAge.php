<?php
declare(strict_types=1);

function checkCorrectAge($age): bool
{
	return (is_numeric($age) && $age >= 0 && $age < 150);
}