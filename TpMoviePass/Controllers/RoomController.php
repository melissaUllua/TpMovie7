<?php
namespace Controllers;

use DAO\RoomDAO as roomDAO;
use Models\Room as Room;
use Models\Cinema as Cinema;
use DAOBD\RoomDAOBD as RoomDAOBD;
use DAOBD\CinemaDAOBD as CinemaDAOBD;

class RoomController{
    private $roomDAO;
    private $roomDAOBD;

    public function __construct()
    {
       // $this->roomDAO = new RoomDAO();
        $this->roomDAO= new RoomDAOBD();
    }

    public function ShowAddView($idCinema, $message ="")
    {   var_dump($idCinema);
        require_once(VIEWS_PATH."add-room.php");
    }
   

    public function ShowListView()
    {
        $cinemaList = $this->roomDAO->getAll();
        require_once(VIEWS_PATH."room-list.php");
    }
    public function ShowEditView()
    {
        $cinemaList = $this->roomDAO->getAll();
        require_once(VIEWS_PATH.".php");
    }

    public function Add($cinemaID, $RoomName, $RoomCapacity, $RoomIs3D, $RoomPrice, $RoomAvailability)
    {
        $cinemaDAO = new CinemaDAOBD();
        $cinema = $cinemaDAO->getOneCinema($cinemaID);
        $room = new Room();
        $room->setRoomName($RoomName);
        $room->setRoomCapacity($RoomCapacity);
        $is3D = ($RoomIs3D = 1) ? true : false;
        $room->setRoomIs3D($is3D);
        $room->setRoomPrice($RoomPrice);
        $availability = ($RoomAvailability = 1) ? true : false;
        $room->setRoomAvailability($availability);
       // $room->setRoomCinemaID($cinemaID);
        
        $this->roomDAOBD->Add($room);
        $message = "El cine fue agregado con exito!";

        
        require_once(VIEWS_PATH."add-cinema.php");
    }
    public function Edit($roomID, $roomName, $roomCapacity, $Is3D, $roomTicketPrice)
    {
        $modify = new Room();
        if ($roomName != "")
        {
            $modify->setroomName($roomName);
        }
        if ($cinemaAddress != "")
        {
            $modify->setroomCapacity($roomCapacity);
        }
        if ($cinemaTotalCapacity != "")
        {
            $modify->setIs3D($Is3D);
        }
        if ($cinemaTicketPrice != "")
        {
            $modify->setroomTicketPrice($roomTicketPrice);
        }

        //$this->roomDAO->Edit($roomID, $modify); /*is not working yet*/
        $message = "Cinema modified successfully";

        $this->ShowListView();
    }
}


?>