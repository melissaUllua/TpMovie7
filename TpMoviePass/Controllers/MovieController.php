<?php
namespace Controllers;


use DAO\MovieDAO as MovieDAO;
use DAO\GenreDAO as GenreDAO;
use DAOBD\MovieDAOBD as MovieDAOBD;
use DAOBD\GenreDAOBD as GenreDAOBD;



class MovieController{
    private $MovieDao;
    private $MovieDaoBD;

    public function __construct()
    {
      //  $this->MovieDao = new MovieDAO();
        $this->MovieDao = new MovieDAOBD();
      //  $this->GenreDao = new GenreDAO();
        $this->GenreDao = new GenreDAOBD();
    }


    public function ShowAddView($message ="")   //no usar.
    {
        require_once(VIEWS_PATH."addmoviebygenre.php");
    }


    public function ShowListView()    //va a ser para listar peliculas por género
    {
        $this->MovieDao->updateDatabaseMovies();
        require_once(VIEWS_PATH."select-genre.php");
        require_once(VIEWS_PATH."movies-list-by-genre.php");

    }


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

}


?>