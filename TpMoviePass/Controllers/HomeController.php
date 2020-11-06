<?php
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use DAOBD\MovieDAOBD as MovieDAOBD;
    use DAOBD\GenreDAOBD as GenreDAOBD;
    
    class HomeController
    {
        public function Index($message = "") //in case I want to display a message to the user
        {
            $movies = new MovieDAOBD();
            $genres = new GenreDAOBD();

<<<<<<< HEAD
           // $movieList = $movies->updateDatabaseMovies();
           // $genreList = $genres->updateDatabaseGenres();
           // require_once(VIEWS_PATH."select-genre.php");
           // require_once(VIEWS_PATH."movies-list-by-genre.php");
           require_once(VIEWS_PATH."signUp.php");

=======

            $movieList = $movies->getAll();
            $genreList = $genres->getAll();
            //var_dump($genreList);
            
            require_once(VIEWS_PATH."movies-list.php"); 
>>>>>>> 5c402a77a0c06e8b71fbc192c45a934bb609c258

        }        
    }
?>