<?php
namespace Controllers;

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
        $this->GenreDaoBD = new GenreDAOBD();
    }


    public function ShowAddView($message ="")   //no usar.
    {
        require_once(VIEWS_PATH."addmoviebygenre.php");
    }


    /*public function ShowListView()    //va a ser para listar peliculas por género
    {
        $movieList =  $genreDaoBD->getMoviesByIdGenre($idGenreShown);
        $this->MovieDao->updateDatabaseMovies();
       // require_once(VIEWS_PATH."select-genre.php");
        require_once(VIEWS_PATH."movies-list-by-genre.php");

    }*/

    public function updateDatabases()    
    {
       // $movies = new MovieDAOBD();
       // $genres = new GenreDAOBD();
       
        $this->MovieDao->updateDatabaseMovies();
        $this->GenreDaoBD->updateDatabaseGenres();
        $genreList = $this->GenreDao->getAll();
        
        echo ("Base de datos correctamente actualizada");
        require_once(VIEWS_PATH."movies-list.php");
    }

    public function ShowListViewByGenre($idGenre)    ///ver de que vista viene
    {
       $movieList = $this->MovieDao->getMoviesByGenre($idGenre);
       $genreSelected = new Genre();
       $genreSelected = $this->GenreDaoBD->searchById($idGenre);
        require_once(VIEWS_PATH."movies-list-by-genre.php");
    }

    public function ShowListView()    ///ver de que vista viene
    {
        $genreList =$this->GenreDaoBD->getAll();

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