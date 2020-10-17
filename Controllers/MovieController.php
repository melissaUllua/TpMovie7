<?php
namespace Controllers;

//use DAO\Movie as MovieDao;
//use Models\Cinema as Cinema;

class CinemaController{
    private $MovieDao;

    public function __construct()
    {
        $this->MovieDao = new MovieDao();
    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH."add-movie.php");
    }

    public function ShowListView()
    {
        $cinemaList = $this->MovieDao->getAll();
        require_once(VIEWS_PATH."movie-list.php");
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