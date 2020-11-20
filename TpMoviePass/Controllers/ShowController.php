<?php
namespace Controllers;

use \Exception as Exception;
use \PDOException as PDOException;
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
        try{
           $movieDao = new MovieDAOBD();
           $movieList = $movieDao->getAll(); 
           $room = new Room();
           $room->setRoomId($roomID);
        }
        catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdoE->getMessage();
            }
            
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {
            require_once(VIEWS_PATH."add-show.php");
        }
      
    }

    public function ShowListView($message="")
    {
        $showList = array();
        try{
            $showList = $this->showDAO->GetAll();
        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdoE->getMessage();
            }
            
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {
        require_once(VIEWS_PATH."shows-list.php");
        }
    }

    public function ShowAvailableListView($message="")
    {
        $showList = array();
        try{
            $showList = $this->showDAO->GetAvailable();
            $purchase = new PurchaseDAOBD();
        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdoE->getMessage();
            }       
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {
        require_once(VIEWS_PATH."shows-list.php");
        }
    }

    public function ShowListByMovie($idMovie)
    {
        $showList = array();
        try{ 
            $showList = $this->showDAO->getShowsByMovie($idMovie);
            
        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdoE->getMessage();
            }
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {
        require_once(VIEWS_PATH."showListByMovie.php");
        }
    }


/*
    public function ShowEditView()
    {
        $showList = array();
        try{
            $showList = $this->showDAO->getAll();
        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdoE->getMessage();
            }
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {
        require_once(VIEWS_PATH."show-edit.php");
        }
    }
*/
    public function Add($movieId, $showDate, $showTime, $roomID)
    {
        if ($this->verifyDate($showDate, $showTime) >= 0){
            try {
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
                                $message = "There has been a problem";
                                $this->showAvailableListView($message);
                            }
                             else {
                                
                                $this->showAvailableListView($message);
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
                
            } catch(PDOException $pdoE){
                if($pdoE->getCode() == 1045){
                    $message = "Wrong DB Password";
                } else{
                    $message = $pdoE->getMessage();
                }
                $this->ShowAddView($roomID, $message);
            }
            catch(Exception $e){
                $message = $e->getMessage();
                $this->ShowAddView($roomID, $message);
            }      
    }
    else if($this->verifyDate($showDate, $showTime) == -1){
        $message = "You should choose a future date";
        $this->ShowAddView($roomID, $message);
    } else {
        $message = "You should choose a time between 14:00 and 23:59";
        $this->ShowAddView($roomID, $message);
    }
}
         /**
          *Recibe un día y un horario, y lo compara con la fecha actual.
          *  @return 1 los datos por parámetros son mayores, 0 si son iguales, -1 si son menores que la fecha actual, -2 si el horario está por fuera de atención del cine
          */ 
            

        public function verifyDate($date, $time){
            $todayDate = date("Y-m-d");
            $todayTime = date("H:i:s");
            $minTime = "14:00";
            $maxTime = "23:59";
       
            if (($time > $minTime) && ($time < $maxTime)){
            if ($todayDate < $date){
                $reply = 1; //si la fecha pasada por parámetro es mayor
            }else if ($todayDate == $date){
                if  ($todayTime < $time){
                        $reply = 0; //si coinciden en dia, pero no en horario
                } else {
                    $reply = -1; //para fechas y/u horarios pasados
                }
            }
        } 
        else {
            $reply = -2;
        }
            return $reply;
    } 
        
    /*
            Verifica que no haya ventas de la función y si no, procede a borrarla
     */
    public function DeleteShow($idShow){
       
        try{ 
            $purchaseDao = new PurchaseDAOBD();
            if ($purchaseDao->ExistsPurchaseByShow($idShow) == false){
                    $this->showDAO->DeleteShow($idShow);
                    $message = "Show deleted successfully";
            }
            else {
                $message = "Show cannot be deleted. There are purchases registrated";
            }
        }catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdoE->getMessage();
            }
        }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally{
            $this->ShowAvailableListView($message);
        }
        }
    }


?>