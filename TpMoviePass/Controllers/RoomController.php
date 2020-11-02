<?php
namespace Controllers;

use DAO\RoomDAO as roomDao;
use Models\Room as Room;
use Models\Cinema as Cinema;
use DAOBD\RoomDAOBD as RoomDAOBD;

class RoomController{
    private $roomDao;
    private $roomDAOBD;

    public function __construct()
    {
        $this->roomDao = new RoomDao();
        $this->roomDAOBD= new RoomDAOBD();
    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH."add-room.php");
    }

    public function ShowListView()
    {
        $cinemaList = $this->roomDao->getAll();
        require_once(VIEWS_PATH."room-list.php");
    }
    public function ShowEditView()
    {
        $cinemaList = $this->roomDao->getAll();
        require_once(VIEWS_PATH.".php");
    }

    public function Add($RoomName, $RoomCapacity, $RoomIs3D, $RoomPrice, $RoomAvailability /*$cinemaID*/)
    {
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
    public function Edit($roomID, $roomName, $roomCapacity, $roomIs3D, $roomPrice)
    {
        $modify = new Room();
        if ($roomName != "")
        {
            $modify->setCinemaName($roomName);
        }
        if ($cinemaAddress != "")
        {
            $modify->setRoomCapacity($roomCapacity);
        }
        if ($cinemaTotalCapacity != "")
        {
            $modify->setRoomIs3D($roomIs3D);
        }
        if ($cinemaTicketPrice != "")
        {
            $modify->setRoomPrice($roomPrice);
        }

        //$this->roomDao->Edit($roomID, $modify); /*is not working yet*/
        $message = "El cine fue editado con exito!";

        $this->ShowListView();
    }
}


?>