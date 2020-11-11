<?php
namespace Controllers;

use Models\Show as Show;
use DAO\ShowDAO as ShowDAO;
use DAOBD\ShowDAOBD as ShowDAOBD;
use DAOBD\MovieDAOBD as MovieDAOBD;
use DAOBD\CinemaDAOBD as CinemaDAOBD;
use DAOBD\PurchaseDAOBD as PurchaseDAOBD;

use Models\Room as Room;
use Models\Movie as Movie;


class ShowController{
    private $showDAO;


    public function __construct()
    {
       // $this->showDAO = new ShowDAO();
        $this->showDAO = new ShowDAOBD();
    }

    public function ShowAddView($roomID,$message="")
    {
        $movieDao = new MovieDAOBD();
        $movieList = $movieDao->getAll();
        $room = new Room();
        $room->setRoomId($roomID);
        require_once(VIEWS_PATH."add-show.php");
    }

    public function ShowListView($message="")
    {
        $showList = $this->showDAO->GetAll();
        require_once(VIEWS_PATH."shows-list.php");
    }

    public function ShowAvailableListView($message="")
    {
        $showList = $this->showDAO->GetAvailable();
        require_once(VIEWS_PATH."shows-list.php");
    }

    public function ShowListByMovie($idMovie)
    {
       // var_dump($idMovie);
        $showList = array();
        $showList = $this->showDAO->getShowsByMovie($idMovie);
       
        require_once(VIEWS_PATH."showListByMovie.php");
    }



    public function ShowEditView()
    {
        $showList = $this->showDAO->getAll();
        require_once(VIEWS_PATH."show-edit.php");
    }

    public function Add($movieId, $showDate, $showTime, $roomID)
    {
        if ($this->verifyDate($showDate, $showTime, $roomID) >= 0){

            if ($this->showDAO->ExistsShowByDateTime($showDate, $showTime, $roomID) == false){ //checkeo que no haya otra función para el mismo día y horario
                               
                if ( $this->showDAO->ExistsMovieInRoom($showDate, $movieId, $roomID) != true){ //checkeo que la película no esté en proyección ese día en otra sala (cine)

                    $show = new show();
                    $show->setShowDate($showDate);
                    $show->setShowTime($showTime);
    
                    $movie = new Movie();
                    $movie->setId($movieId);
        
                    $room = new Room();
                    $room->setRoomId($roomID);
                    
                    $show->setShowMovie($movie);
                    $show->setShowRoom($room);

                    if ($this->showDAO->checkTime($show) == true){ //checkeo que no se superponga con otra función
                        $message = $this->showDAO->Add($show); //agrego
                         if (empty($message)){
                            $message = "Show added successfully";
                            // require_once(VIEWS_PATH."cinemas-list.php");
                            $this->showListView($message);
                        }
    
                         else {
                            $cinema = new CinemaDAOBD();
                            $cinemaList = $cinema->GetAll(); 
                            $this->showListView();
                        }
                
                    } else {
                        $message = "There is another function already scheduled. Please choose another time.";
                        $this->ShowAddView($roomID, $message);
                    }
   

                }
                else {
                    $message = "This movie is already in exhibition. Please choose another one.";
                    $this->ShowAddView($roomID, $message);
                }
               

            } else {
                $message = "There already exists a Show scheduled on that day and time";
                $this->ShowAddView($roomID, $message);
            }
            
        } else {
            $message = "You should choose a future date";
            $this->ShowAddView($roomID, $message);
        }
     
    }
         /* 
            Recibe un día y un horario, y lo compara con la fecha actual. 
            Retorna 1 los datos por parámetros son mayores, 0 si son iguales, -1 si son menores que la fecha actual
        */

        public function verifyDate($date, $time){
            $todayDate = date("Y-m-d");
            $todayTime = date("H:i:s");
       
            
            if ($todayDate < $date){
                $flag = 1; //si la fecha pasada por parámetro es mayor
            }else if ($todayDate == $date){
                if  ($todayTime < $time){
                    $flag = 0; //si coinciden en dia, pero no en horario
                } else {
                    $flag = -1; //para fechas y/u horarios pasados
                }
          
            return $flag;
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
    /*
            Verifica que no haya ventas de la función y si no, procede a borrarla
     */
    public function DeleteShow($idShow){
        $purchaseDao = new PurchaseDAOBD();
        if ($purchaseDao->ExistsPurchaseByShow($idShow) == 0){
                $this->showDAO->DeleteShow($idShow);
                $message = "Show deleted successfully";
        }
        else {
            $message = "Show cannot be deleted. There are purchases registrated";
        }

        $this->ShowAvailableListView($message);
    }
}


?>