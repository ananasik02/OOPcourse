DROP DATABASE IF EXISTS musicshop;

CREATE DATABASE musicshop;

USE musicshop;


CREATE TABLE singers
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
) ENGINE = InnoDB;


CREATE TABLE styles
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
) ENGINE = InnoDB;

CREATE TABLE alboms
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    singer_id INT UNSIGNED,
    name VARCHAR(50),
    FOREIGN KEY (singer_id) REFERENCES singers(id)
        ON DELETE CASCADE

) ENGINE = InnoDB;


CREATE TABLE songs
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL,
    singer_id INT UNSIGNED,
    albom_id INT UNSIGNED ,
    year INT UNSIGNED,
    style_id INT UNSIGNED,
    path TEXT NOT NULL,
    duration TIME,
    codec TEXT NOT NULL,
    FOREIGN KEY (singer_id) REFERENCES singers(id)
        ON DELETE CASCADE,
    FOREIGN KEY (albom_id) REFERENCES alboms(id)
        ON DELETE CASCADE,
    FOREIGN KEY (style_id) REFERENCES styles(id)
        ON DELETE CASCADE

) ENGINE = InnoDB;

INSERT INTO singers(name) VALUES
(
    'Nadia'
),
(
    'Nazar'
),
(
    'Maria'
);

INSERT INTO styles (name)
VALUES
(
    'Country'
),
(
    'Rock'
),
(
    'Pank'
),
(
    'Indie'
);


INSERT INTO alboms(name, singer_id)
VALUES
(
    'I love you',
    1
),
(
    'Test albom 2',
    2
),
(
    'My course albom',
    2
);

INSERT INTO songs(name, singer_id, albom_id, year, style_id, path, duration, codec)
VALUES
(
    'Love of my life',
    2,
    1,
    2002,
    4,
    '/yyyyuu/uyttt',
    4.05,
    'hfi6380'
),
(
    'Miy miy',
    3,
    2,
    2001,
    2,
    '/yyyyuu/uyttt',
    2.45,
    'h64j80'
),
(
    'Lalalend',
    1,
    1,
    1999,
    3,
    '/yyyyuu/uyttt',
    5.25,
    'hf75780'
);

SELECT * FROM singers;
USE musicshop;
SELECT * FROM styles;
USE musicshop;
SELECT * FROM alboms;
USE musicshop;
SELECT * FROM songs;