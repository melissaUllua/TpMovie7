<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Movie as Movie;    
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
                    $genre->setId($row['id']);
                    $genre->setName($row['GenreName']);
                    array_push($this->genreList, $genre);
                }
                return $this->genreList;
            } catch (\Throwable $th) {
                throw $th;
            }
        }


        public function searchById($idGenre)  //busca un genero por su ID y lo devuelve como objeto
        {

            $query = "SELECT * FROM " . $this->tableName . " WHERE IdGenre=:$IdGenre";
    
            $parameters["IdGenre"] = $idGenre;

            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);

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

            $query = "SELECT * FROM Genres_by_movies WHERE IdGenre=:$IdGenre ORDER BY (MovieReleaseDate) DESC";
            $parameters["IdGenre"] = $idGenre;


            try {
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
                $resultSet = $resultSet->fetchAll();


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




    }
?>