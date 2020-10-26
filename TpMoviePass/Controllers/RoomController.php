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
        require_once(VIEWS_PATH."add-room.php");
    }

    public function ShowListView()
    {
        $cinemaList = $this->roomDao->getAll();
        require_once(VIEWS_PATH."movies-list.php");
    }
    public function ShowEditView()
    {
        $cinemaList = $this->roomDao->getAll();
        require_once(VIEWS_PATH.".php");
    }

    public function ShowCinemasView()
    {
        $cinemaList = $this->roomDao->getAll();
        header("Location: ". FRONT_ROOT . VIEWS_PATH . "cinemas-list.php");
    }
    
    //public function Add($roomID, $roomName, $roomCapacity, $roomIs3D, $roomTicketPrice)
    public function Add($roomName, $roomCapacity, $roomIs3D, $roomTicketPrice)
    {
        $room = new Room();
        //$room->setRoomId($roomID);
        $room->setRoomName($roomName);
        $room->setRoomCapacity($roomCapacity);
        $room->setIs3D($roomIs3D);
        $room->setRoomTicketPrice($roomTicketPrice);
       
        $message = $this->roomDao->Add($room);
        if (empty($message)){
            $message = "Show Room added successfully";
           // $this->ShowCinemasView(); //se rompe
           $this->ShowListView();
            //require_once(VIEWS_PATH."add-cinema.php");
        } else {
            $this->ShowAddView($message);
        }
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

        //$this->roomDao->Edit($roomID, $modify); /*is not working yet*/
        $message = "El cine fue editado con exito!";

        $this->ShowListView();
    }
}


?>