<?php
namespace Controllers;

use Models\Show as Show;
use DAO\ShowDAO as ShowDAO;
use DAOBD\ShowDAOBD as ShowDAOBD;
use DAOBD\MovieDAOBD as MovieDAOBD;

use Models\Room as Room;
use Models\Movie as Movie;


class ShowController{
    private $showDAO;
    private $showDAOBD;

    public function __construct()
    {
       // $this->showDAO = new ShowDAO();
        $this->showDAO = new ShowDAOBD();
    }

    public function ShowAddView($roomID)
    {
        //$movieDao = new MovieDAOBD();
        //$movieList = $movieDao->getAll();
        $room = new Room();
        $room->setRoomId($roomID);
        require_once(VIEWS_PATH."add-show.php");
    }

    public function ShowListView()
    {
        $showList = $this->showDAO->GetAll();
        require_once(VIEWS_PATH."shows-list.php");
    }
    public function ShowEditView()
    {
        $showList = $this->showDAO->getAll();
        require_once(VIEWS_PATH."show-edit.php");
    }

    public function Add( $roomId, $showDate, $showTime)
    {//ACÁ FALTAN TODOS LOS CHECKEOS!
        $today = date("Y-m-d");
        if (strcmp($showDate, $today)> 0){
            $show = new show();
            $show->setShowDate($showDate);
            $show->setShowTime($showTime);
    
            $movie = new Movie();
            $movie->setId(50);
    
            $room = new Room();
            $room->setRoomId($roomId);
    
            $show->setShowMovie($movie);
            $show->setShowRoom($room);
            //var_dump("algo!".$show);
            //var_dump($show);
            $message =  $this->showDAO->Add($show);
            if (empty($message)){
                $message = "Show added successfully";
                   $this->ShowAddView($message);
                    //require_once(VIEWS_PATH."add-show.php");
                    var_dump("algo!".$show);
            }
            
            else {
                $this->ShowAddView($message);
            }

        }

       
        
        
        
    }
    
  /*  public function Edit($id, $showName, $showAddress, $showTotalCapacity, $showTicketPrice, $showAvailabiity)
    {
        $modify = new show();
        if ($showName != "")
        {
            $modify->setshowName($showName);
        }
        if ($showAddress != "")
        {
            $modify->setshowAddress($showAddress);
        }
        if ($showTotalCapacity != "")
        {
            $modify->setshowTotalCapacity($showTotalCapacity);
        }
        if ($showTicketPrice != "")
        {
            $modify->setshowTicketPrice($showTicketPrice);
        }
        if ($showAvailabiity != "")
        {
            $modify->setshowAvailability($showAvailabiity);
        }

        $this->showDAO->Edit($id, $modify);
        $message = "El cine fue editado con exito!";

        $this->ShowListView();
    }
    */
}


?>