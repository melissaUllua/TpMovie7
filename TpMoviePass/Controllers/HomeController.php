<?php
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use DAOBD\MovieDAOBD as MovieDAOBD;
    use DAOBD\GenreDAOBD as GenreDAOBD;
    use DAOBD\ShowDAOBD as ShowDAOBD;

    
    class HomeController
    {
        public function Index($message = "") //in case I want to display a message to the user
        {
            $movies = new MovieDAOBD();
            $genres = new GenreDAOBD();
            $shows = new ShowDAOBD();



            $movieList = $movies->getAll();
            $genreList = $genres->getAll();
            $showsList = $shows->GetBillboard();
            
            require_once(VIEWS_PATH."showBillboard.php"); 

        }        
    }
?>