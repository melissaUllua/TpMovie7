<?php
namespace Controllers;

use DAO\GenreDAO as GenreDAO;
use DAOBD\GenreDAOBD as GenreDAOBD;

class GenreController{
    private $GenreDao;

    public function __construct()
    {
        $this->GenreDao = new GenreDAO();
    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH."add-movie.php");
    }

    public function ShowListView()
    {
        $genreList = $this->GenreDao->getAll();
        require_once(VIEWS_PATH."movies-list.php");

    }

}


?>