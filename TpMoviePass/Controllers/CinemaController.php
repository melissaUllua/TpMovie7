<?php
namespace Controllers;

use DAO\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
use DAOBD\CinemaDAOBD as CinemaDAOBD;

class CinemaController{
    private $cinemaDAO;
    private $cinemaDAOBD;

    public function __construct()
    {
        $this->cinemaDAO = new CinemaDAO();
        $this->cinemaDAOBD = new CinemaDAOBD();
    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH."add-cinema.php");
    }

    public function ShowListView()
    {
        $cinemaList = $this->cinemaDAOBD->getAvailable();
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

    public function Add($cinemaName, $cinemaAddress, /*$cinemaTotalCapacity, $cinemaTicketPrice*/ $cinemaAvailability)
    {
        $cinema = new Cinema();
       // $cinema->setCinemaId($cinemaID); lo agregamos desde el DAO
        $cinema->setCinemaName($cinemaName);
        //$cinema->setCinemaTotalCapacity($cinemaTotalCapacity); lo calculamos desde el DAOBD
        //$cinema->setCinemaTicketPrice($cinemaTicketPrice); va en el room
        $cinema->setCinemaAddress($cinemaAddress);
        $availability = ($cinemaAvailability = 1) ? true : false;
        $cinema->setCinemaAvailability($availability);
       // $cinema->setCinemaTotalRooms($cinemaTotalRooms); //agregar a la bdd tambn
        //$this->cinemaDAO->Add($cinema);
        var_dump($cinema);
        $this->cinemaDAOBD->Add($cinema);
        

        $message = "El cine fue agregado con exito!";
       //$totalRooms = $cinemaTotalRooms;
        require_once(VIEWS_PATH."add-room.php");
    }
    public function AddRoom($roomID, $roomName, $roomCapacity, $roomIs3D, $roomPrice, $cinemaID)
    {
        $room = new Room();
        $room->setRoomId($roomID);
        $room->setRoomName($roomName);
        $room->setRoomCapacity($roomCapacity);
        $room->setRoomIs3D($roomIs3D);
        $room->setRoomPrice($roomPrice);
        $room->setRoomCinemaID($cinemaID);


        $this->roomDao->Add($room);
        var_dump($room->getRoomCinemaID);
        $message = "El cine fue agregado con exito!";

        //$this->ShowAddView(); //we should see if we keep this
        
        require_once(VIEWS_PATH."add-cinema.php");
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