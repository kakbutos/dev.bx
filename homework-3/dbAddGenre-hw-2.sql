# 1. Вывести список фильмов, в которых снимались одновременно Арнольд Шварценеггер* и Линда Хэмилтон*.
#   Формат: ID фильма, Название на русском языке, Имя режиссёра.

SELECT m.ID, mt.TITLE, d.NAME
FROM movie m
INNER JOIN movie_title mt ON m.ID = mt.MOVIE_ID
INNER JOIN director d ON d.ID = m.DIRECTOR_ID
WHERE
    mt.LANGUAGE_ID = 'ru'
	AND m.ID IN
    (
		SELECT ma.MOVIE_ID
        FROM movie_actor ma
        WHERE ma.ACTOR_ID = 1
	)
    AND m.ID IN
    (
        SELECT ma.MOVIE_ID
        FROM movie_actor ma
        WHERE ma.ACTOR_ID = 3
	);

# 2. Вывести список названий фильмов на англйском языке с "откатом" на русский, в случае если название на английском не задано.
#    Формат: ID фильма, Название.

SELECT m.ID, IFNULL(mt_en.TITLE, mt_ru.TITLE) AS TITLE
FROM movie m
LEFT JOIN movie_title mt_en on m.ID = mt_en.MOVIE_ID AND mt_en.LANGUAGE_ID = 'en'
LEFT JOIN movie_title mt_ru on m.ID = mt_ru.MOVIE_ID AND mt_ru.LANGUAGE_ID = 'ru';

# 3. Вывести самый длительный фильм Джеймса Кэмерона*.
#  Формат: ID фильма, Название на русском языке, Длительность.
# (Бонус – без использования подзапросов)

# с подзапросом
SELECT m.ID, mt.TITLE, m.LENGTH
FROM movie m
LEFT JOIN movie_title mt ON m.ID = mt.MOVIE_ID AND mt.LANGUAGE_ID = 'ru'
WHERE DIRECTOR_ID = 1
  AND m.LENGTH IN (SELECT MAX(m1.LENGTH) FROM movie m1);

# без подзапроса
SELECT m.ID, mt.TITLE, m.LENGTH
FROM movie m
LEFT JOIN movie_title mt ON m.ID = mt.MOVIE_ID AND mt.LANGUAGE_ID = 'ru'
WHERE DIRECTOR_ID = 1
ORDER BY m.LENGTH DESC
	LIMIT 1;

# 4. ** Вывести список фильмов с названием, сокращённым до 10 символов. Если название короче 10 символов – оставляем как есть. Если длиннее – сокращаем до 10 символов и добавляем многоточие.
#  Формат: ID фильма, сокращённое название

SELECT  mt.MOVIE_ID, IF((CHAR_LENGTH(mt.TITLE) > 10), CONCAT(LEFT(mt.TITLE, 10), '...'), mt.TITLE) AS TITLE
FROM movie_title mt;

# 5. Вывести количество фильмов, в которых снимался каждый актёр.
#    Формат: Имя актёра, Количество фильмов актёра.

SELECT a.NAME, COUNT(ma.MOVIE_ID) AS FILMS
FROM movie_actor ma
LEFT JOIN actor a ON a.ID = ma.ACTOR_ID
GROUP BY a.ID;

# 6. Вывести жанры, в которых никогда не снимался Арнольд Шварценеггер*.
#   Формат: ID жанра, название

SELECT *
FROM genre g
WHERE g.ID NOT IN
      (
	      SELECT mg.GENRE_ID
	      FROM movie_actor ma
		  INNER JOIN movie_genre mg on ma.MOVIE_ID = mg.MOVIE_ID
	      WHERE ma.ACTOR_ID = 1
      );

# 7. Вывести список фильмов, у которых больше 3-х жанров.
#   Формат: ID фильма, название на русском языке

SELECT m.ID, mt.TITLE
FROM movie m
LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID AND mt.LANGUAGE_ID = 'ru'
INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
GROUP BY m.ID
HAVING COUNT(mg.GENRE_ID) > 3;

# 8. Вывести самый популярный жанр для каждого актёра.
#   Формат вывода: Имя актёра, Жанр, в котором у актёра больше всего фильмов.

SELECT a.NAME, g.NAME
FROM actor a
INNER JOIN movie_actor ma ON a.ID = ma.ACTOR_ID
INNER JOIN movie m ON ma.MOVIE_ID = m.ID
INNER JOIN movie_genre mg ON m.ID = mg.MOVIE_ID
INNER JOIN genre g ON mg.GENRE_ID = g.ID
WHERE g.NAME =
	(
		SELECT g1.NAME
		FROM actor a1
		INNER JOIN movie_actor ma1 ON a1.ID = ma1.ACTOR_ID
		INNER JOIN movie m1 ON ma1.MOVIE_ID = m1.ID
	    INNER JOIN movie_genre mg1 ON m1.ID = mg1.MOVIE_ID
		INNER JOIN genre g1 ON mg1.GENRE_ID = g1.ID
		WHERE ma1.ACTOR_ID = a.ID
		GROUP BY g1.NAME
		ORDER BY COUNT(1) desc LIMIT 1
	)
GROUP BY a.NAME, g.NAME;