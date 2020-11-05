<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Movie as Movie;    
    use Models\Genre as Genre;    

    use DAOBD\Connection as Connection;
    use DAOBD\MovieDAOBD as MovieDAOBD;
    

    class GenreDAOBD
    {
        private $genreList  = array();
        private $connection;
        private $tableName = "Genres";
    
        public function __construct()
        {
            $this->genreList = array();
        }



        public function add(Genre $genre)   //agrega un genero a la base de datos
        {
    
            $query = "INSERT INTO " . " " . $this->tableName . " " .
                " (IdGenre, GenreName) VALUES
                    (:IdGenre,:GenreName);";
    
            $parameters["IdGenre"] = $genre->getId();
            $parameters["GenreName"] = $genre->getName();

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (\Throwable $ex) {
    
                throw $ex;
            }
        }

        public function getAll()    ///devuelve una lista de todos los generos
        {
    
            $query = "SELECT * FROM" . ' ' . $this->tableName;
            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row) {
                    $genre = new Genre();
                    $genre->setId($row['IdGenre']);
                    $genre->setName($row['GenreName']);
                    array_push($this->genreList, $genre);
                }
                //var_dump($this->genreList);
                return $this->genreList;
            } catch (\Throwable $th) {
                throw $th;
            }
        }


        public function searchById($idGenre)  //busca un genero por su ID y lo devuelve como objeto
        {

            $query = "SELECT * FROM " . $this->tableName . " WHERE IdGenre= $idGenre";
    
            //$parameters["IdGenre"] = $idGenre;

            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);

                if ($resultSet != null) {
                    $genre = new Genre();
                    $genre->setId($resultSet[0]["IdGenre"]);
                    $genre->setName($resultSet[0]["GenreName"]);

                    return $genre;
                } else {
                    return null;
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }


        public function getMoviesByIdGenre($idGenre)  //busca peliculas que coincidan con el ID de genero que le pasemos
        {
            $movieList = array();
            $IdMovie = null;
            $movieDAOBD = new MovieDAOBD;

            $query = 'SELECT * FROM Genres_by_movies WHERE IdGenre = "' . $idGenre .'";';

            $parameters["IdGenre"] = $idGenre;


            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
               // $resultSet = $resultSet->fetchAll();


                if ($resultSet != null) {
                    foreach($resultSet as $row){
                        $movie = new Movie();
                        $movieID = $row['IdMovie'];
                        $movie = $movieDAOBD->searchById($movieID);

                        array_push($movieList, $movie);
                    }


                    return $genre;
                } else {
                    return null;
                }

            } catch (\Throwable $th) {
                throw $th;
            }


        }

        public function exists(Genre $genre)   //se fija por ID si existe. Si existe, la devuelve entera. si no, la agrega. va a servir para el update
    {

      

        //$parameters["IdGenre"] = $genre->getId();

        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE IdGenre = " . $genre->getId() . ";"; ///cambiar
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            
        
        } catch (\Throwable $th) {
            throw $th;
        }
    }







    public function updateDatabaseGenres()
    {

        $jsonContent = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=cbd53a3628e9ef7454e5890f33b974d8'); //guarda en jsoncontent un string con lo que te tira cada pagina
        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();  //convierte ese string en un arreglo asociativo
       // exidump($jsonContent);


        try {

            if (!empty($arrayToDecode['genres']))
            {  //si la api funciona, hay algo en el arreglo en posicion "results". si no funciona la api, esto deberia estar vacio o no existir
                foreach ($arrayToDecode['genres'] as $valueArray)
                {  
                    //dentro de la posicion results hay un arreglo de movies. por eso el for each, para recorrerlo entero
                    $genre = new Genre(); //creamos el objeto movie y le damos los datos
                    $genre->setId($valueArray['id']);
                    $genre->setName($valueArray['name']);                                     
                   // var_dump($genre);
                    $this->exists($genre); //mandamos a chequear si existe en DB. Si no existe, la agrega.
                }
            }
        
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    }
?>