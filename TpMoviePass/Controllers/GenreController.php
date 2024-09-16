<?php
namespace Controllers;

use \Exception as Exception;
use \PDOException as PDOException;
use DAO\GenreDAO as GenreDAO;
use DAOBD\MovieDAOBD as MovieDAOBD;
use DAOBD\GenreDAOBD as GenreDAOBD;


class GenreController{
    private $GenreDao;

    public function __construct()
    {
        // $this->GenreDao = new GenreDAO();
        $this->GenreDao = new GenreDAOBD();

    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH."add-movie.php");
    }

    public function ShowListView()
    {
        $genreList = array();
        try{
            $genreList = $this->GenreDao->getAll();
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
            require_once(VIEWS_PATH."movies-list.php");
        }
    }

}


?>