<?php
    namespace Controllers;
    use \Exception as Exception;
    use \PDOException as PDOException;
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

            try {
                $movieList = $movies->getAll();
                $genreList = $genres->getAll();
                $showsList = $shows->GetBillboard();
            }
            catch(PDOException $pdoE){
                if($pdoE->getCode() == 1045){
                    $message = "Wrong DB Password";
                } else{
                    $message = $pdoE->getMessage();
                }
                
            }
            catch(Exception $e){
                $message = $e->getMessage();
            }
            finally
            {
                require_once(VIEWS_PATH."showBillboard.php"); 
            }

        }        
    }
?>