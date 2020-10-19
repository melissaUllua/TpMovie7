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
        $cinemaList = $this->cinemaDAO->getAll();
        require_once(VIEWS_PATH."cinema-edit.php");
    }

    public function Add($cinemaID, $cinemaName, $cinemaAddress, $cinemaTotalCapacity, $cinemaTicketPrice, $cinemaAvailabiity)
    {
        $cinema = new Cinema();
        $cinema->setCinemaId($cinemaID);
        $cinema->setCinemaName($cinemaName);
        $cinema->setCinemaTotalCapacity($cinemaTotalCapacity);
        $cinema->setCinemaTicketPrice($cinemaTicketPrice);
        $cinema->setCinemaAddress($cinemaAddress);
        $cinema->setCinemaAvailability($cinemaAvailabiity);

        $this->cinemaDAO->Add($cinema);

        $message = "El cine fue agregado con exito!";

        $this->ShowAddView(); //we should see if we keep this
    }
    public function Edit($id, $cinemaName, $cinemaAddress, $cinemaTotalCapacity, $cinemaTicketPrice, $cinemaAvailabiity)
    {
        $modify = new Cinema();
        if ($cinemaName != "")
        {
            $modify->setCinemaName($cinemaName);
        }
        if ($cinemaAddress != "")
        {
            $modify->setCinemaAddress($cinemaAddress);
        }
        if ($cinemaTotalCapacity != "")
        {
            $modify->setCinemaTotalCapacity($cinemaTotalCapacity);
        }
        if ($cinemaTicketPrice != "")
        {
            $modify->setCinemaTicketPrice($cinemaTicketPrice);
        }
        if ($cinemaAvailabiity != "")
        {
            $modify->setCinemaAvailability($cinemaAvailabiity);
        }

        $this->cinemaDAO->Edit($id, $modify);
        $message = "El cine fue editado con exito!";

        $this->ShowListView();
    }
}


?>