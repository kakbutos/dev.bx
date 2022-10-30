-- ЗАДАНИЕ 1



-- CREATE TABLES
-- участники
CREATE TABLE member
(
	ID int not null auto_increment,
	NAME varchar(128) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE movie_member
(
	MOVIE_ID int not null,
	MEMBER_ID int not null,
	PRIMARY KEY (MOVIE_ID, MEMBER_ID),
	FOREIGN KEY FK_MM_MOVIE (MOVIE_ID)
		REFERENCES movie(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_MM_MEMBER (MEMBER_ID)
		REFERENCES member(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

-- должности
CREATE TABLE position
(
	ID int not null auto_increment,
	NAME varchar(128) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE member_position
(
	MEMBER_ID int not null,
	POSITION_ID int not null,
	PRIMARY KEY (MEMBER_ID, POSITION_ID),
	FOREIGN KEY FK_MP_MEMBER (MEMBER_ID)
		REFERENCES member(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_MP_POSITION (POSITION_ID)
		REFERENCES `position`(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

-- роли
CREATE TABLE role
(
	ID int not null auto_increment,
	NAME varchar(128) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE actor_role
(
	ACTOR_ID int not null,
	ROLE_ID int not null,
	PRIMARY KEY (ACTOR_ID, ROLE_ID),
	FOREIGN KEY FK_AR_ACTOR (ACTOR_ID)
		REFERENCES actor(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_MP_ROLE (ROLE_ID)
		REFERENCES role(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

ALTER TABLE actor ADD COLUMN MEMBER_ID int not null;
ALTER TABLE actor ADD FOREIGN KEY (MEMBER_ID) REFERENCES member(ID);



-- ЗАДАНИЕ 2

-- Вывести фильмы, где режиссер Джеймс Кэмерон
select mt.TITLE, d.NAME
from movie
	     inner join movie_title mt on movie.ID = mt.MOVIE_ID
	     inner join director d on movie.DIRECTOR_ID = d.ID
where d.ID = 1;

-- создание индекса
ALTER TABLE director
	ADD INDEX director_name (ID);

-- Вывести фильмы, у которых рейтинг больше 6
select mt.TITLE, m.RATING
from movie_title mt
	     inner join movie m on mt.MOVIE_ID = m.ID
where m.RATING > 6;

-- создание индекса
ALTER TABLE movie
	ADD INDEX movie_min_age (RATING);



-- ЗАДАНИЕ 3

-- Найти людей, которые одновременно были режиссером и продюссером какого-либо фильма

-- Найти все фильмы, имеющие двойников по названию на русском языке.
SELECT MOVIE_ID, TITLE
FROM movie_title
WHERE
    TITLE IN
(
	SELECT TITLE
	FROM movie_title
	GROUP BY TITLE
	HAVING COUNT(*) > 1
);