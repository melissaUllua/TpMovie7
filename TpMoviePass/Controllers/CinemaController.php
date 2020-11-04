<?php
namespace Controllers;

use DAO\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
use DAOBD\CinemaDAOBD as CinemaDAOBD;

class CinemaController{
    private $cinemaDAO;
    //private $cinemaDAO; 

    public function __construct()
    {
       // $this->cinemaDAO = new CinemaDAO();
        $this->cinemaDAO = new CinemaDAOBD();
    }

    public function ShowAddView($message ="")
    {
        
        require_once(VIEWS_PATH."add-cinema.php");
        
    }

    public function ShowListView()
    {
        
       $cinemaList = $this->cinemaDAO->GetAll();
        require_once(VIEWS_PATH."cinemas-list.php");
    }
    public function ShowEditView()
    {
        $cinemaList = $this->cinemaDAO->getAll();
        require_once(VIEWS_PATH."cinema-edit.php");
    }
    /*public function ShowRoomsList() no debe ser de rooms debe ser de funciones
    {
        require_once(VIEWS_PATH."room-list.php");
    }*/ 

    public function Add($cinemaName, $cinemaAddress, $cinemaAvailability, $cinemaTotalRooms)
    {
        $cinema = new Cinema();
       
        $cinema->setCinemaName($cinemaName);
     
        $cinema->setCinemaAddress($cinemaAddress);
        $availability = ($cinemaAvailability = 1) ? true : false;
        $cinema->setCinemaAvailability($availability);
        
        $this->cinemaDAO->Add($cinema);
        $message =  $this->cinemaDAO->Add($cinema);
        if (empty($message)){
            $message = "Cinema added successfully";
            //$cinemaID = $thisCinemaDAOBD->get
            $totalRooms = $cinemaTotalRooms;
              $this->ShowListView($message);
        }
        else {
            $this->ShowAddView($message);
        }
        
        
        
    }

    public function Edit($id, $cinemaName, $cinemaAddress, $cinemaAvailabiity)
    {
        $modify = new Cinema();
        if ($cinemaName != "")
        {
            $modify->setCinemaName($cinemaName);
        }
        if ($cinemaAddress != "")
        {
            $modify->setCinemaAddress($cinemaAddress);
        
        if ($cinemaAvailabiity != "")
        {
            $availability = ($cinemaAvailability = 1) ? true : false;
            $modify->setCinemaAvailability($availability);
        }

        $this->cinemaDAO->EditCinema($modify, $id);
        $message = "El cine fue editado con exito!";

        $this->ShowListView();
    }
}
}


?>