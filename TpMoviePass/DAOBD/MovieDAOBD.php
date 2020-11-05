<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Movie as Movie;    
    use Models\Genre as Genre; 
    use DAOBD\Connection as Connection;
    use DAOBD\GenreDAOBD as GenreDAOBD;


    class MovieDAOBD
    {
        private $moviesList  = array();
        private $connection;
        private $tableName = "Movies";
    
        public function add(Movie $movie)   //agrega una pelicula a la base de datos
        {
    
            $query = "INSERT INTO " . " " . $this->tableName . " " . 
                " (IdMovie, MovieTitle, MovieOriginalTitle, MovieDuration,MovieOverview,MovieReleaseDate,MovieIsAdult,MoviePosterPath, MovieOriginalLanguage) VALUES
                    (:IdMovie,:MovieTitle,:MovieOriginalTitle,:MovieDuration,:MovieOverview,:MovieReleaseDate,:MovieIsAdult,:MoviePosterPath,:MovieOriginalLanguage);";
    
            
            $parameters["IdMovie"] = $movie->getId();
            $parameters["MovieTitle"] = $movie->getTitle();
            $parameters["MovieOriginalTitle"] = $movie->getOriginal_title();
            $parameters["MovieDuration"] = $movie->getDuration();
            $parameters["MovieOriginalLanguage"] = $movie->getOriginal_language();
           
            $parameters["MovieOverview"] = $movie->getOverview();

            $parameters["MovieReleaseDate"] = $movie->getRelease_date();
            if ($movie->getAdult()) {
                $parameters["MovieIsAdult"] = 1;
            } else {
                $parameters["MovieIsAdult"] = 0;
            }
            $parameters["MoviePosterPath"] = $movie->getPoster_path();

           

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                $this->addGenresByMovies($movie);
            } catch (\Throwable $ex) {
               
                throw $ex;
            }
        }


        public function exists(Movie $movie)   //se fija por ID si existe. Si existe, la devuelve entera. si no, la agrega. va a servir para el update
        {
    
        try {
                $query = 'SELECT * FROM '. $this->tableName . ' WHERE  IdMovie = ' . $movie->getId() . ';';
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                //var_dump($resultSet);
               
                return $resultSet;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    



        public function getAll()   ///trae todas las pelis de la BDD, en orden segun movie release date
        {
    
    
            $this->moviesList = array();
            $query = "SELECT * FROM " . $this->tableName . " ;";
            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
               // var_dump($resultSet);
                foreach ($resultSet as $row) {
    
                    $movie = new Movie();
                    $movie->setId($row['IdMovie']);
                    $movie->setTitle($row['MovieTitle']);
                    $movie->setOriginal_language($row['MovieOriginalLanguage']);
                    $movie->setOriginal_title($row['MovieOriginalTitle']);
                    $movie->setDuration($row['MovieDuration']);
                    $movie->setOverview($row['MovieOverview']);
                    $movie->setRelease_date($row['MovieReleaseDate']);
                    $movie->setPoster_path($row['MoviePosterPath']);
                    $movie->setGenresArray($this->addGenresToMovies($movie->getId()));


                    if ($row['MovieIsAdult'] == 1) {
                        $movie->setAdult(true);
                    } else {
                        $movie->setAdult(false);
                    }
    
                    array_push($this->moviesList, $movie);
                }
                   //echo "BASE DE DATOS";
                return $this->moviesList;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    


        public function searchById($id)  //busca una pelicula por su ID
        {

            $query = 'SELECT * FROM ' . $this->tableName .' WHERE IdMovie = "' . $id .'";';
    
            //$parameters["IdMovie"] = $id;
            //var_dump($query);
            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                if ($resultSet != null) {
                    $movie = new Movie();
                    $movie->setId($resultSet[0]["IdMovie"]);
                    $movie->setTitle($resultSet[0]["MovieTitle"]);
                    $movie->setDuration($resultSet[0]["MovieDuration"]);
                    $movie->setOriginal_language($resultSet[0]["MovieOriginalLanguage"]);
                    $movie->setOriginal_title($resultSet[0]['MovieOriginalTitle']);
                    $movie->setOverview($resultSet[0]["MovieOverview"]);
                    $movie->setRelease_date($resultSet[0]["MovieReleaseDate"]);

                    if ($resultSet[0]['MovieIsAdult'] == 1) {
                        $movie->setAdult(true);
                    } else {
                        $movie->setAdult(false);
                    }

                    $movie->setPoster_path($resultSet[0]["poster_path"]);
                    //$movie->setGenresArray(addGenresToMovies($movie->getId()));

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

            $arrayGenres = array();

            $query = "SELECT IdGenre FROM Genres_by_movies WHERE IdMovie = ". $idMovie . ";";

            //$parameters["IdMovie"] = $idMovie;

            $DAOGenre = new GenreDAOBD();


            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);

                if ($resultSet != null) {
                    foreach($resultSet as $row)
                        $genre = new Genre();
                        $genre = $DAOGenre->searchById($row['IdGenre']);
                        array_push($arrayGenres, $genre);
    
                } else {

                    return null;
                }

                return $arrayGenres;

            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function updateDatabaseMovies()  
        {
    
            $jsonContent = file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=cbd53a3628e9ef7454e5890f33b974d8'); //guarda en jsoncontent un string con lo que te tira cada pagina
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();  //convierte ese string en un arreglo asociativo
    


            try {

                if (!empty($arrayToDecode['results'])){                                       //si la api funciona, hay algo en el arreglo en posicion "results". si no funciona la api, esto deberia estar vacio o no existir
                    foreach ($arrayToDecode['results'] as $valueArray){                       //dentro de la posicion results hay un arreglo de movies. por eso el for each, para recorrerlo entero
                        $movie = new Movie();                                                 //creamos el objeto movie y le damos los datos
                        $movie->setPoster_path($valueArray['poster_path']);
                        $movie->setId($valueArray['id']);                                     
                        $movie->setAdult($valueArray['adult']);
                        $movie->setOriginal_Language($valueArray['original_language']);
                        $movie->setOriginal_title($valueArray['original_title']);
                       $movie->setGenresArray($valueArray['genre_ids']); 
                        $movie->setTitle($valueArray['title']);
                        $movie->setOverview($valueArray['overview']); 
                        $movie->setRelease_date($valueArray['release_date']); 
                        $movie->setDuration($this->getMovieDuration($valueArray['id']));

                        //$this->exists($movie);  
                        //var_dump($this->exists($movie)); 
                        if(!$this->exists($movie))
                        {
                            $this->add($movie);
                           // $this->addGenresByMovies($movie);
                        }        //mandamos a chequear si existe en DB. Si no existe, la agrega.
                    }
                }
            
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function getMovieDuration ($idMovie)   ///trae la duracion de la peli en minutos
        {

            $jsonContent = file_get_contents('https://api.themoviedb.org/3/movie/' . $idMovie . '?api_key=cbd53a3628e9ef7454e5890f33b974d8');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();  //convierte ese string en un arreglo asociativo

            return $arrayToDecode['runtime'];
        }


        public function addGenresByMovies(Movie $movie)
        {

            $genresArray = $movie->getGenresArray();
            //var_dump($genresArray);

            foreach($genresArray as $movieGenre)
            {
                $query = "INSERT INTO Genres_by_movies (IdMovie, IdGenre) VALUES (:IdMovie,:IdGenre);";
        
                $parameters["IdMovie"] = $movie->getId();
                $parameters["IdGenre"] = $movieGenre;


                try {
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                } catch (\Throwable $ex) {
        
                    throw $ex;
                }
            }
        }


        public function getMoviesByGenre($genreId)   ///trae todas las pelis de la BDD, en orden segun movie release date
        {
    
            $this->moviesList = array();
            $query = "SELECT IdMovie FROM Genres_by_movies WHERE IdGenre = " . $genreId . ";";
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {

                    $movie = new Movie();

                    $movie = $this->searchById($row['IdMovie']);
    
                    array_push($this->moviesList, $movie);
                }

                return $this->moviesList;

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