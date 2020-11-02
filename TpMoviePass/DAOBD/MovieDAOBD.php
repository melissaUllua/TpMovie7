<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Movie as Movie;    
    use DAOBD\Connection as Connection;

    class MoviesDAOBD
    {
        private $moviesList  = array();
        private $connection;
        private $tableName = "Movies";
    
        public function add(Movie $movie)   //agrega una pelicula a la base de datos
        {
    
            $query = "INSERT INTO " . " " . $this->tableName . " " .
                " (IdMovie, MovieTitle, MovieOriginalTitle, duration,original_language,MovieOverview,release_date,adult,poster_path) VALUES
                    (:IdMovie,:MovieTitle,:MovieOriginalTitle,:duration,:original_language,:MovieOverview,:release_date,:adult,:poster_path);";
    
            $parameters["IdMovie"] = $movie->getId();
            $parameters["MovieTitle"] = $movie->getTitle();
            $parameters["MovieOriginalTitle"] = $movie->getOriginalTitle();
            $parameters["duration"] = $movie->getDuration();
            $parameters["original_language"] = $movie->getOriginalLanguage();
            $parameters["MovieOverview"] = $movie->getOverview();
            $parameters["release_date"] = $movie->getReleaseDate();
            if ($movie->getAdult()) {
                $parameters["adult"] = 1;
            } else {
                $parameters["adult"] = 0;
            }
            $parameters["poster_path"] = $movie->getPosterPath();
            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (\Throwable $ex) {
    
                throw $ex;
            }
        }


        public function exists(Movie $movie)   //se fija por ID si existe. Si existe, la devuelve entera. si no, la agrega. va a servir para el update
        {
    
            $query = "SELECT * FROM " . " " . $this->tableName . " WHERE IdMovie=:IdMovie";
    
            $parameters["IdMovie"] = $movie->getId();

            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
    
                if (!empty($resultSet)) {
                    $movie = new Movie();
                    $movie->setId($resultSet[0]['id']);
                    $movie->setTitle($resultSet[0]['title']);
                    $movie->setDuration($resultSet[0]['duration']);
                    $movie->setOriginalLanguage($resultSet[0]['original_language']);
                    $movie->setOverview($resultSet[0]['overview']);
                    $movie->setReleaseDate($resultSet[0]['release_date']);
                    $movie->setAdult($resultSet[0]['adult']);
                    $movie->setPosterPath($resultSet[0]['poster_path']);
                    return $movie;
                } else {
                    add($movie);
                    return false;
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    
        public function getAll()
        {
    
    
            $this->moviesList = array();
            $query = "SELECT * FROM" . ' ' . $this->tableName . " " . "order by (MovieReleaseDate) desc";
            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row) {
    
                    $movie = new Movie();
                    $movie->setId($row['IdMovie']);
                    $movie->setTitle($row['MovieTitle']);
                    $movie->setOriginalLanguage($row['MovieOriginalLanguage']);
                    $movie->setOriginalTitle($row['MovieOriginalTitle']);
                    $movie->setDuration($row['MovieDuration']);
                    $movie->setOverview($row['MovieOverview']);
                    $movie->setReleaseDate($row['MovieReleaseDate']);
                    $movie->setPosterPath($row['MoviePosterPath']);

                    if ($row['MovieIsAdult'] == 1) {
                        $movie->setAdult(true);
                    } else {
                        $movie->setAdult(false);
                    }
    
                    array_push($this->moviesList, $movie);
                }
    
                return $this->moviesList;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    


        public function searchById($id)  //busca una pelicula por su ID
        {

            $query = "SELECT * FROM " . " " . $this->tableName . " WHERE id=:id";
    
            $parameters["id"] = $id;
            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
                if ($resultSet != null) {
                    $movie = new Movie();
                    $movie->setId((int) $resultSet[0]["id"]);
                    $movie->setTitle($resultSet[0]["title"]);
                    $movie->setDuration($resultSet[0]["duration"]);
                    $movie->setOriginalLanguage($resultSet[0]["original_language"]);
                    $movie->setOverview($resultSet[0]["overview"]);
                    $movie->setReleaseDate($resultSet[0]["release_date"]);
                    $movie->setAdult($resultSet[0]["adult"]);
                    $movie->setPosterPath($resultSet[0]["poster_path"]);
                    $movie->setGenresArray(addGenresToMovies($movie->getId()))
    
                    return $movie;
                } else {
                    return null;
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }




        public function addGenresToMovies($idMovie)  //devuelve un arreglo de objetos Genre para añadir a la pelicula
        {

            $arrayGenres = null;

            $query = "SELECT IdGenre FROM Genres_by_movies WHERE IdMovie=:$idMovie";

            $parameters["IdMovie"] = $idMovie;

            $DAOGenre = new GenreDAOBD();


            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
                if ($resultSet != null) {
                    foreach($resultSet as $row)
                        $genre = new Genre();
                        $genre = $DAOGenre->searchById($row);
                        array_push($arrayGenres, $genre);
    
                } else {

                    return null;
                }

                return $arrayGenres;

            } catch (\Throwable $th) {
                throw $th;
            }
        }









        /*
        public function delete($id)   //da de baja la pelicula por su id (baja logica). la funcion no esta completa. NO USAR
        {
    
            $query = "UPDATE" . " " . $this->tableName . " " . "SET" .  " WHERE id=:id";
            $parameters["id"] = $id;
            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        */
    }
    

    ?>