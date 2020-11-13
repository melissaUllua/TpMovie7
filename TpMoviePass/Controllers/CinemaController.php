<?php
namespace Controllers;

use \Exception as Exception;
use \PDOException as PDOException;
use DAO\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
use DAOBD\CinemaDAOBD as CinemaDAOBD;
use DAOBD\RoomDAOBD as RoomDAOBD;
use DAOBD\ShowDAOBD as ShowDAOBD;


class CinemaController{
    private $cinemaDAO;
    //private $cinemaDAO; 

    public function __construct()
    {
       // $this->cinemaDAO = new CinemaDAO();
        $this->cinemaDAO = new CinemaDAOBD();
    }

    public function ShowAddView($message ="")
    { 
        require_once(VIEWS_PATH."add-cinema.php");   
    }

    public function ShowListView($message = "")
    {
        $cinemaList = array();
        try{
            $cinemaList = $this->cinemaDAO->GetAll();
        }
       catch(PDOException $pdoE){
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
        require_once(VIEWS_PATH."cinemas-list.php");
    }
    }

    public function ShowEditView($message = "")
    {
        $cinemaList = $this->cinemaDAO->getAll();
        require_once(VIEWS_PATH."cinema-edit.php");
    }
    /*public function ShowRoomsList() no debe ser de rooms debe ser de funciones
    {
        require_once(VIEWS_PATH."room-list.php");
    }*/ 

    public function Add($cinemaName, $cinemaAddress, $cinemaAvailability= true, $cinemaTotalRooms= null)
    {
        $cinema = new Cinema();
       
        $cinema->setCinemaName($cinemaName);
     
        $cinema->setCinemaAddress($cinemaAddress);
        $availability = ($cinemaAvailability = 1) ? true : false;
        $cinema->setCinemaAvailability($availability);
        try{
            $this->cinemaDAO->Add($cinema);
        $message =  $this->cinemaDAO->Add($cinema);
        if (empty($message)){
            $message = "Cinema added successfully";
            //$cinemaID = $thisCinemaDAOBD->get
            $totalRooms = $cinemaTotalRooms;
              $this->ShowListView($message);
        }
        else {
            $this->ShowAddView($message);
        }

        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
                $this->ShowAddView($message);
            } else{
                $message = $pdo->getMessage();
                $this->ShowAddView($message);
            }
        }
        catch(Exception $e){
            $message = $e->getMessage();
            $this->ShowAddView($message);
        }    
    }

    public function Edit($id, $cinemaName, $cinemaAddress, $cinemaAvailabiity)
    {
        $modify = new Cinema();
        if ($cinemaName != "")
        {
            $modify->setCinemaName($cinemaName);
        }
        if ($cinemaAddress != "")
        {
            if ($this->cinemaDAO->checkNewAddress($cinemaAddress, $id) == false){
                $modify->setCinemaAddress($cinemaAddress);
            } else {
                $message = "There is a cinema with the same address you have specified.";
                $this->ShowEditView($message);
            }
        }
        if ($cinemaAvailabiity != "")
        {
            $availability = ($cinemaAvailabiity == 1) ? true : false;
            if ($availability == false){
                if($this->checkFutureShowsInCinema($id)== 1){ //verifica que no haya futuras funciones en el cine
                    $message = "Cannot modify availability. There are programmed shows still."; //si las hay muestra un error
                    $this->ShowEditView($message);
                    $modify->setCinemaAvailability(true); 
                   
                }else {
                    $modify->setCinemaAvailability($availability);   
                   
                }
            } else if ($availability == true) {
                $modify->setCinemaAvailability($availability);
            } 
        }
        
        try{
            $flag = $this->cinemaDAO->EditCinema($modify, $id); //arroja 1 si lo agrega bien o 0 si se produce un error
        if ($flag == 0){
            $message = "Cinema edited successfully!";
            $this->ShowListView($message);
        } else {
            $message = "There has been a problem";
            $this->ShowEditView($message);
        }
        }
        catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
                $this->ShowEditView($message);
            } else{
                $message = $pdo->getMessage();
                $this->ShowEditView($message);
            }
            
        }
        catch(Exception $e){
            $message = $e->getMessage();
            $this->ShowEditView($message);
        }         
   
    }

    /*
        trae un listado de salas asociadas al cine, verifica ue no haya funciones futuras. Si encuentra alguna, retorna 1, si no, retorna 0
     */

    public function checkFutureShowsInCinema($idCinema){
        $flag = 0;
        $roomDao = new RoomDAOBD();
        $showDao = new ShowDAOBD();
        $roomsList = $roomDao->GetRoomsByCinema($idCinema); //me traigo todas las salas asociadas al cine
        foreach ($roomsList as $room){
            if ($showDao->IsAnyFutureShowInRoom($room->getRoomId())){  //por cada una chequeo que no haya funciones
                $flag = 1; //si en alguna hay, arrojo un mensaje
            }
        }
        return $flag;
    }


}



?>