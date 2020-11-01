<?php
namespace Controllers;

use DAO\RoomDAO as roomDao;
use Models\Room as Room;

class RoomController{
    private $roomDao;

    public function __construct()
    {
        $this->roomDao = new RoomDao();
    }

    public function ShowAddView($message ="")
    {
        require_once(VIEWS_PATH.".php");
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

    public function Add($roomID, $roomName, $roomCapacity, $roomIs3D, $roomPrice, $cinemaID)
    {
        //$cinema = unserialize($cinemaSER);
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