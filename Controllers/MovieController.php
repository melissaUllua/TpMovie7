<?php
namespace Controllers;

use \Exception as Exception;
use \PDOException as PDOException;
use Models\Movie as Movie;
use Models\Genre as Genre;
use DAO\MovieDAO as MovieDAO;
use DAO\GenreDAO as GenreDAO;
use DAOBD\MovieDAOBD as MovieDAOBD;
use DAOBD\GenreDAOBD as GenreDAOBD;


class MovieController{
    private $MovieDao;
    private $MovieDaoBD;
    private $GenreDaoBD;

    public function __construct()
    {
      //  $this->MovieDao = new MovieDAO();
        $this->MovieDao = new MovieDAOBD();
      //  $this->GenreDao = new GenreDAO();
        $this->GenreDao = new GenreDAOBD();
    }


    public function updateDatabases()    
    {
       $genreList = array();
       if((isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1))){
           try {
            $this->MovieDao->updateDatabaseMovies();
            $this->GenreDao->updateDatabaseGenres();
            $genreList = $this->GenreDao->getAll();
            
            $message = "Upgraded Database";
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
        $this->ShowListViewByGenre($message);
        }
    }   
    else {
        $message = "Denied Access";
        $this->ShowListView($message);
    }
        
    }

    public function ShowListViewByGenre($idGenre, $message ="")    ///ver de que vista viene
    {  
        $genreSelected = new Genre();
        try {
            if($idGenre == 0){
                $movieList = $this->MovieDao->getAll();
                $genreSelected = null;
            }else{
                $movieList = $this->MovieDao->getMoviesByGenre($idGenre);
                $genreSelected = $this->GenreDao->searchById($idGenre);
         
            }
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
            require_once(VIEWS_PATH."movies-list-by-genre.php");
        }
    }

    public function ShowListView($message ="")    ///ver de que vista viene
    {
        $genreList = array();
        try {
            $genreList =$this->GenreDao->getAll();
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

/// FUNCIONES NO USADAS
/*
    public function ShowAddView($message ="")   //no usar.
    {
        require_once(VIEWS_PATH."addmoviebygenre.php");
    }
*/


/*    public function ShowListView()    ///ver de que vista viene
    {
        $genreList =$this->GenreDaoBD->getAll();
        require_once(VIEWS_PATH."movies-list.php");
    }
*/
    /*public function ShowListView()    //va a ser para listar peliculas por género
    {
        $movieList =  $genreDaoBD->getMoviesByIdGenre($idGenreShown);
        $this->MovieDao->updateDatabaseMovies();
       // require_once(VIEWS_PATH."select-genre.php");
        require_once(VIEWS_PATH."movies-list-by-genre.php");
    }*/
/*
    public function ShowEditView()
    {
        require_once(VIEWS_PATH."movie-edit.php");
    }

    public function Add($title, $relaseDate, $originalLanguage)
    {///debe hacerlo de la API, pero es prueba
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->setRleaseDate($relaseDate);
        $movie->setOriginalLanguage($originalLanguage);
        

        $this->MovieDao->Add($movie);

        $this->ShowAddView(); //we should see if we keep this
    }
    public function EditMovie($title, $relaseDate, $originalLanguage)
    {
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->setRleaseDate($relaseDate);
        $movie->setOriginalLanguage($originalLanguage);

        $this->MovieDao->Add($movie);

        //$this->ShowListView();
    }
*/
}

?>