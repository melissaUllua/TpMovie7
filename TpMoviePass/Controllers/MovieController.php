<?php
namespace Controllers;

use DAO\MovieDAO as MovieDAO;
use Models\Cinema as Cinema;

class MovieController{
    private $MovieDao;

    public function __construct()
    {
        $this->MovieDao = new MovieDAO();
    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH."add-movie.php");
    }

    public function ShowListView()
    {
        //$movieList = $this->MovieDao->getAll();
        $movieList = $this->MovieDao->retrieveDataFromAPI();
        require_once(VIEWS_PATH."movies-list.php");
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