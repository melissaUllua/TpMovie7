<?php
namespace Controllers;

use \Exception as Exception;
use \PDOException as PDOException;
use DAO\RoomDAO as roomDAO;
use Models\Room as Room;
use Models\Cinema as Cinema;
use DAOBD\RoomDAOBD as RoomDAOBD;
use DAOBD\CinemaDAOBD as CinemaDAOBD;
use DAOBD\ShowDAOBD as ShowDAOBD;

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
        $roomList = array();
        try{
            $roomList = $this->roomDAO->GetRoomsByCinema($cinemaID);
        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdo->getMessage();
            }
            
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {        
            require_once(VIEWS_PATH."rooms-list.php");
        }
    }

    /*public function ShowAvailableView($cinemaID) ///no funciona, idk why
    {
         $roomList = $this->roomDAO->getAvailable($cinemaID);
        require_once(VIEWS_PATH."rooms-list.php");
    }*/

    public function ShowEditView($roomID, $message="")
    {
        $room = new Room();
        try{
            $room = $this->roomDAO->getOneRoom($roomID);
        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdo->getMessage();
            }
            
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {
            require_once(VIEWS_PATH."room-edit.php");
        }
    }


    public function Add($RoomName, $RoomCapacity, $RoomIs3D, $RoomPrice,$cinemaID, $RoomAvailability= 1) //disponible por defecto
    {
       // $cinemaDAO = new CinemaDAOBD();
        //$cinema = $cinemaDAO->getOneCinema($cinemaID);
        try{
            $flag = $this->roomDAO->ExistsRoomByName($RoomName, $cinemaID);
            if($flag == false){
                    $cinema = new Cinema();
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
                    $this->ShowAddView($cinemaID, $message);
            }

        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdo->getMessage();
            }
            $this->ShowAddView($cinemaID, $message);
            
        }
        catch(Exception $e){
            $message = $e->getMessage();
            $this->ShowAddView($cinemaID, $message);
        }
    }

    public function Edit($roomID, $roomName, $roomCapacity, $roomPrice, $Is3D, $roomAvailability, $idCinema)
    {
        $modify = new Room();
        try{
            if ($roomName != "")
        {
           
            if ($this->roomDAO->checkNewName($roomName, $roomID, $idCinema) == false){
                $modify->setroomName($roomName);
            } else {
                $message = "There is a room with the same name in this cinema.";
                $this->ShowEditView($idCinema, $message);
            }
        }
        if ($roomCapacity != "")
        {
            $modify->setroomCapacity($roomCapacity);
        }
        if ($Is3D != "")
        {
            $modify->setIs3D($Is3D);
        }
        if ($roomPrice != "")
        {
            $modify->setroomPrice($roomPrice);
        }
        if ($roomAvailability != "")
        {
            $availability = ($roomAvailability == 1) ? true : false; //transformo el boolean en un int para enviar a la bbdd
            $showDao = new ShowDAOBD();
            if ($availability == false){ //en caso de que quieran dar de baja la sala
                if ($showDao->IsAnyFutureShowInRoom($roomID) == true){ //chequeo que no haya funciones
                    $message = "Cannot modify availability. There are programmed shows for this room yet."; //si las hay muestra un error
                    $this->ShowEditView($idCinema, $message);
                } else {
                    $modify->setRoomAvailability($availability);
                }
            } 
            $modify->setRoomAvailability($availability);
        }

        $this->roomDAO->Edit($modify, $roomID);
        $message = "Room modified successfully";

        $this->ShowListView($idCinema);

   }catch(PDOException $pdoE){
    if($pdoE->getCode() == 1045){
        $message = "Wrong DB Password";
    } else{
        $message = $pdo->getMessage();
    }
    $this->ShowEditView($idCinema, $message);
}
catch(Exception $e){
    $message = $e->getMessage();
    $this->ShowEditView($idCinema, $message);
}     
    
}
}

?>