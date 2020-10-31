drop database if exists tpmoviepass;
CREATE DATABASE IF NOT EXISTS tpmoviepass;

use tpmoviepass;

create table if not exists Cinemas (IdCinema int not null auto_increment,
								  CinemaName varchar(40) not null,
								  CinemaAddress varchar(50) not null,
                                  CinemaAvailability boolean not null,
                                  constraint pkIdCinema primary key(idCinema),
                                  CONSTRAINT unq_cinemaAddress UNIQUE (CinemaAddress)
);


select * from Cinema;

create table if not exists Rooms (IdRoom int not null auto_increment,
								IdCinema int not null,
								RoomName varchar(20) not null,
                                RoomCapacity int not null,
                                RoomIs3D boolean not null default false,
                                RoomPrice int not null,
                                RoomAvailability boolean not null,
                                constraint pk_IdRoom primary key(IdRoom),
                                constraint fk_IdCinema foreign key(IdCinema) references Cinema(IdCinema)
								CONSTRAINT unq_roomName UNIQUE (RoomName),
);
                                
create table if not exists Users  (IdUser int not null auto_increment,
								   UserFirstName varchar (30) not null,
								   UserLastName varchar (30) not null,
								   UserName varchar(30) not null,
                                   UserPass varchar(30) not null,
                                   UserIsActive boolean not null default true,
                                   UserEmail varchar(40) not null,
                                   UserIsAdmin boolean not null default false,
                                   constraint pkIdUser primary key(IdUser),
                                   CONSTRAINT unq_email UNIQUE (UserEmail),
                                   CONSTRAINT unq_username UNIQUE (UserName)
);



create table if not exists Movies (IdMovie int not null,
								  MovieTitle varchar(50) not null,
                                  MovieOverview varchar(500),
                                  MovieOriginalTitle varchar (50),
                                  MovieOriginalLanguage int not null,
                                  MovieIsAdult boolean default true,
                                  MovieDuration int not null,
                                  MoviePosterPath varchar (30),
                                  MovieReleaseDate date,
                                  constraint unq_IdMovie UNIQUE (IdMovie),
                                  constraint pk_MovieId PRIMARY KEY (MovieId),
                                  constraint fk_OriginalLanguage FOREIGN KEY (MovieOriginalLanguage) REFERENCES Languages(IdLanguage) ON DELETE CASCADE ON UPDATE CASCADE
);



create table if not exists  Genres (genresId int not null,
							IdGenre int not null,
							GenreName varchar(50) not null,
							constraint pk_genres PRIMARY KEY (id),
							constraint unq_genres UNIQUE (genre_name)
);
                                  
                                  
create table if not exists  Genres_by_movies(
							id_movie int,
							id_genre int,
							constraint pk_genres_by_movies_id_movie_id_genre PRIMARY KEY (id_movie, id_genre),
							constraint fk_genres_by_movies_id_movie FOREIGN KEY (id_movie) REFERENCES movies(id) ON DELETE CASCADE ON UPDATE CASCADE,
							constraint fk_genres_by_movies_id_genre FOREIGN KEY (id_genre) REFERENCES genres(id) ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists  Languages(
							IdLanguage int auto_increment,
							LanguageName varchar(5) not null,
							constraint pk_language PRIMARY KEY(IdLanguage),
							constraint unq_name_language UNIQUE(name_language)
);
