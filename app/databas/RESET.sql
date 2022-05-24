DROP TABLE IF EXISTS energy_source;
DROP TABLE IF EXISTS energy_share_sweden;
DROP TABLE IF EXISTS energy_share_world;
DROP TABLE IF EXISTS books;

CREATE TABLE energy_share_world (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year INTEGER NOT NULL, percentage VARCHAR(255) NOT NULL);
CREATE TABLE energy_share_sweden (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year INTEGER NOT NULL, percentage VARCHAR(255) NOT NULL);
CREATE TABLE energy_source (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, bio VARCHAR(255) DEFAULT NULL, water VARCHAR(255) DEFAULT NULL, wind VARCHAR(255) DEFAULT NULL, heat VARCHAR(255) DEFAULT NULL, sun VARCHAR(255) DEFAULT NULL, total VARCHAR(255) DEFAULT NULL, year INTEGER NOT NULL);
CREATE TABLE books (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, isbn VARCHAR(255) DEFAULT NULL, author VARCHAR(255) NOT NULL, pic VARCHAR(255) DEFAULT NULL);


INSERT INTO energy_share_world (year, percentage) 
VALUES 
    (2000, 17.29), 
    (2001, 17.04), 
    (2002, 17.05),
    (2003, 16.85),
    (2004, 16.51),
    (2005, 16.33),
    (2006, 16.27),
    (2007, 16.15),
    (2008, 16.29),
    (2009, 16.81),
    (2010, 16.56),
    (2011, 16.63),
    (2012, 16.89),
    (2013, 17.06),
    (2014, 17.18),
    (2015, 17.24),
    (2016, 17.48);

INSERT INTO energy_share_sweden (year, percentage)
VALUES 
    (2005, 41),
    (2006, 43),
    (2007, 44),
    (2008, 45),
    (2009, 48),
    (2010, 47),
    (2011, 49),
    (2012, 51),
    (2013, 52),
    (2014, 52),
    (2015, 54),
    (2016, 54),
    (2017, 54);

INSERT INTO energy_source (bio, water, wind, heat, sun, total, year)
VALUES
(92, 68, 1, 7, 0, 168, 2005),
(97, 68, 1, 8, 0, 174, 2006),
(102, 69, 1, 9, 0, 181, 2007),
(102, 67, 2, 10, 0, 181, 2008),
(106, 68, 3, 11, 0, 188, 2009),
(116, 68, 4, 11, 0, 199, 2010),
(109, 69, 6, 14, 0, 197, 2011),
(116, 69, 7, 14, 0, 206, 2012),
(114, 68, 9, 14, 0, 206, 2013),
(114, 65, 11, 14, 0, 205, 2014),
(120, 67, 14, 14, 0, 215, 2015),
(124, 66, 16, 16, 0, 222, 2016),
(129, 66, 17, 16, 0, 229, 2017);


INSERT INTO books (title, isbn, author, pic)
VALUES 
('The Night in Lisbon', 9780091115708, 'Erich Maria Remarque', 'https://upload.wikimedia.org/wikipedia/en/b/b1/The.Night.In.Lisbon.cover.jpg'),
('A Connecticut Yankee in King Arthur’s Court', 123456, 'Mark Twain', 'https://www.publishersweekly.com/images/cached/ARTICLE_PHOTO/photo/000/000/028/28133-v1-185x.JPG'),
('The adventures of Sherlock Holmes', 0759398747, 'Arthur Conan Doyle', 'https://img.thriftbooks.com/api/images/m/16edeba80bcc9aa503e7544ace4f8b7fdb69f771.jpg');




