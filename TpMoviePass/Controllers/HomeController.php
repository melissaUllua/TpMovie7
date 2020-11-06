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

           // $movieList = $movies->updateDatabaseMovies();
           // $genreList = $genres->updateDatabaseGenres();
           // require_once(VIEWS_PATH."select-genre.php");
           // require_once(VIEWS_PATH."movies-list-by-genre.php");
           require_once(VIEWS_PATH."signUp.php");


        }        
    }
?>