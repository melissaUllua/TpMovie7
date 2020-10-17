<?php
namespace Controllers;

use DAO\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;

class CinemaController{
    private $cinemaDAO;

    public function __construct()
    {
        $this->cinemaDAO = new CinemaDAO();
    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH."add-cinema.php");
    }

    public function ShowListView()
    {
        $cinemaList = $this->cinemaDAO->getAll();
        require_once(VIEWS_PATH."cinemas-list.php");
    }
    public function ShowEditView()
    {
        require_once(VIEWS_PATH."cinema-edit.php");
    }

    public function Add(/*$cinemaId,*/ $cinemaName, $cinemaAddress, $cinemaTotalCapacity, $cinemaTicketPrice, $cinemaAvailabiity)
    {
        $cinema = new Cinema();
       // $cinema->setCinemaId($cinemaId);
        $cinema->setCinemaName($cinemaName);
        $cinema->setCinemaTotalCapacity($cinemaTotalCapacity);
        $cinema->setCinemaTicketPrice($cinemaTicketPrice);
        $cinema->setCinemaAddress($cinemaAddress);
        $cinema->setCinemaAvailability($cinemaAvailabiity);

        $this->cinemaDAO->Add($cinema);

        $message = "El cine fue agregado con exito!";

        $this->ShowAddView(); //we should see if we keep this
    }
    public function EditCinema($cinemaName, $cinemaAddress, $cinemaTotalCapacity, $cinemaTicketPrice, $cinemaAvailabiity)
    {
        $modify = new Cinema();
        $modify->setCinemaName($cinemaName);
        $modify->setCinemaTotalCapacity($cinemaTotalCapacity);
        $modify->setCinemaTicketPrice($cinemaTicketPrice);
        $modify->setCinemaAddress($cinemaAddress);
        $modify->setCinemaAvailability($cinemaAvailabiity);

        $this->cinemaDAO->Add($modify);
        $message = "El cine fue editado con exito!";

        $this->ShowListView();
    }
    public function DeleteCinema()
    {
        $cinema = new Cinema();
        $cinema->setcinemaAvailabilit(false);

        $this->cinemaDAO->add($cinema);
    }

}


?>