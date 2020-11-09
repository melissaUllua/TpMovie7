create database if not exists TpMoviePass;

use TpMoviePass;

create table if not exists Cinemas (IdCinema int not null auto_increment,
								  CinemaName varchar(40) not null,
								  CinemaAddress varchar(50) not null,
                                  CinemaAvailability boolean not null default true,
                                  constraint pkIdCinema primary key(idCinema),
                                  CONSTRAINT unq_cinemaAddress UNIQUE (CinemaAddress)
);
create table if not exists Rooms (IdRoom int not null auto_increment,
								IdCinema int not null,
								RoomName varchar(20) not null,
                                RoomCapacity int not null,
                                RoomIs3D boolean not null default true,
                                RoomPrice int not null,
                                RoomAvailability boolean not null,
                                CONSTRAINT pk_IdRoom primary key(IdRoom),
                                CONSTRAINT fk_IdCinema foreign key(IdCinema) references Cinemas(IdCinema),
                                CONSTRAINT unq_cinema_name UNIQUE (RoomName, IdCinema)
);

create table if not exists Users  (IdUser int not null auto_increment,
								   UserFirstName varchar (30) not null,
								   UserLastName varchar (30) not null,
								   UserName varchar(30) not null,
                                   UserPass varchar(30) not null,
                                   UserIsActive boolean not null default true,
                                   UserEmail varchar(40) not null,
                                   UserIsAdmin boolean not null default false,
                                   CONSTRAINT pkIdUser primary key(IdUser),
                                   CONSTRAINT unq_email UNIQUE (UserEmail),
                                   CONSTRAINT unq_username UNIQUE (UserName)
);

create table if not exists Movies (IdMovie int not null,
								  MovieTitle varchar(50) not null,
                                  MovieOverview varchar(500),
                                  MovieOriginalTitle varchar (50),
                                  MovieOriginalLanguage varchar (4),
                                  MovieIsAdult boolean default true,
                                  MovieDuration int not null,
                                  MoviePosterPath varchar (50),
                                  MovieReleaseDate date,
                                  constraint unq_IdMovie UNIQUE (IdMovie),
                                  constraint pk_IdMovie PRIMARY KEY (IdMovie)
);

create table if not exists  Genres (
							IdGenre int not null,
							GenreName varchar(50) not null,
							constraint pk_genres PRIMARY KEY (IdGenre),
							constraint unq_genres UNIQUE (GenreName)
);
                           
                                  
create table if not exists  Genres_by_movies(
							IdMovie int,
							IdGenre int,
							constraint pk_genres_by_movies_id_movie_id_genre PRIMARY KEY (IdMovie, IdGenre),
							constraint fk_genres_by_movies_id_movie FOREIGN KEY (IdMovie) REFERENCES movies(IdMovie) ON DELETE CASCADE ON UPDATE CASCADE,
							constraint fk_genres_by_movies_id_genre FOREIGN KEY (IdGenre) REFERENCES genres(IdGenre) ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists  Shows(
                            IdShow int auto_increment,
                            IdMovie int not null,
                            IdRoom int not null,
                            ShowDate date not null,
                            ShowTime time not null,
                            constraint pk_show PRIMARY KEY(IdShow),
                            constraint pfk_show_idMovie FOREIGN KEY(IdMovie) REFERENCES Movies(IdMovie) ON DELETE CASCADE ON UPDATE CASCADE,
                            constraint pfk_show_idRoom FOREIGN KEY(IdRoom) REFERENCES Rooms(IdRoom) ON DELETE CASCADE ON UPDATE CASCADE
    );