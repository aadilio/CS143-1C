CREATE TABLE Movie(
  id INT PRIMARY KEY, # This is a primary key as it as a trait that would be specific to each Movie
  title VARCHAR(100),
  year INT,
  rating VARCHAR(10),
  company VARCHAR(50),
  CHECK(year < 2019 AND year >=1850) # Check if the year of the movie is in a proper timespan
) ENGINE = INNODB;

CREATE TABLE Actor(
  id INT PRIMARY KEY, # This is a primary key as it as a trait that would be specific to each Actor
  last VARCHAR(20),
  first VARCHAR(20),
  sex VARCHAR(6),
  dob DATE,
  dod DATE,
  CHECK(YEAR(dob) > 1750 AND YEAR(dob) <=2018) # Check if the date of birth of the Actor is in a proper timespan
) ENGINE = INNODB;

CREATE TABLE Director(
  id INT PRIMARY KEY, # This is a primary key as it as a trait that would be specific to each Director
  last VARCHAR(20),
  first VARCHAR(20),
  dob DATE,
  dod DATE,
  CHECK(YEAR(dob) > 1750 AND YEAR(dob) <=2018) # Check if the date of birth of the Director is in a proper timespan
) ENGINE = INNODB;

CREATE TABLE MovieGenre(
  mid INT PRIMARY KEY,
  FOREIGN KEY(mid) REFERENCES Movie(id), # This is a foreign key as the mid can be used to identify the Movie(id)
  genre VARCHAR(20) INT PRIMARY KEY
) ENGINE = INNODB;

CREATE TABLE MovieDirector(
  mid INT PRIMARY KEY,
  FOREIGN KEY(mid) REFERENCES Movie(id), # This is a foreign key as the mid can be used to identify the Movie(id)
  did INT,
  FOREIGN KEY(did) REFERENCES Director(id) # This is a foreign key as the did can be used to identify the Director(id)
) ENGINE = INNODB;

CREATE TABLE MovieActor(
  mid INT PRIMARY KEY,
  aid INT,
  FOREIGN KEY(mid) REFERENCES Movie(id), # This is a foreign key as the mid can be used to identify the Movie(id)
  FOREIGN KEY(aid) REFERENCES Actor(id), # This is a foreign key as the aid can be used to identify the Actor(id)
  role VARCHAR(50)
) ENGINE = INNODB;

CREATE TABLE Review(
  name VARCHAR(20),
  time TIMESTAMP,
  mid INT,
  FOREIGN KEY(mid) REFERENCES Movie(id), # This is a foreign key as the mid can be used to identify the Movie(id)
  rating INT,
  comment VARCHAR(500)
) ENGINE = INNODB;

CREATE TABLE MaxPersonID(
  id INT PRIMARY KEY
) ENGINE = INNODB;

CREATE TABLE MaxMovieID(
  id INT PRIMARY KEY
) ENGINE = INNODB;
