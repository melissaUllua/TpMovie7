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
        $this->roomDAO = new RoomDAOBD();
    }

    public function ShowAddView($idCinema, $message ="")
    {  
        require_once(VIEWS_PATH."add-room.php");
    }
   

    public function ShowListView($cinemaID)
    {

        $roomList = $this->roomDAO->GetRoomByCinemas($cinemaID);
        var_dump($roomList);
        require_once(VIEWS_PATH."rooms-list.php");
    }

    /*public function ShowAvailableView($cinemaID) ///no funciona, idk why
    {
         $roomList = $this->roomDAO->getAvailable($cinemaID);
        require_once(VIEWS_PATH."rooms-list.php");
    }*/

    public function ShowEditView()
    {
        $cinemaList = $this->roomDAO->getAll();
        require_once(VIEWS_PATH.".php");
    }


    public function Add($RoomName, $RoomCapacity, $RoomIs3D, $RoomPrice, $RoomAvailability,$cinemaID)
    {
       // $cinemaDAO = new CinemaDAOBD();
        //$cinema = $cinemaDAO->getOneCinema($cinemaID);
      //  $cinema = new Cinema();
      $room = $this->roomDAO->getOneRoomByName($RoomName);
      if(!isset($room->getRoomName()){
        $cinema->setCinemaId($cinemaID);
        $room = new Room();
        $room->setRoomName($RoomName);
        $room->setRoomCapacity($RoomCapacity);
        $is3D = ($RoomIs3D = 1) ? true : false;
        $room->setIs3D($is3D);
        $room->setRoomPrice($RoomPrice);
        $availability = ($RoomAvailability = 1) ? true : false;
        $room->setRoomAvailability($availability);
        $room->setRoomCinema($cinema);
        $this->roomDAO->Add($room);
        $message = "Show Room added successfully!";
        require_once(VIEWS_PATH."add-cinema.php");
      }
      else {
          $message = "There already exists a Room with that name";
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

        //$this->roomDAO->Edit($roomID, $modify); /*is not working yet*/
        $message = "Cinema modified successfully";

        $this->ShowListView();
    }
}


?>