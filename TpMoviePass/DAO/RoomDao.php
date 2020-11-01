<?php
namespace DAO;

use Models\Room as Room; 

class RoomDAO implements IDAO{
    private $roomList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = dirname(__DIR__) . "/Data/Room.json";
    }

    public function getAll(){
        $this->retrieveData();
        return $this->roomList;
    }

    /**
     * Retrieves all and filters according to availability
     *
     * @return  availableroomList
     */ 
    public function getAvailable(){
        $this->retrieveData();
        return $this->roomList;
    }

    public function Add($room){
        $this->retrieveData(); //obtengo el listado
        if($this->roomList){ //verifico que tenga datos
            $flag = $this->existsByName($room->getroomName()); //verifico que no exista
            if (empty($flag)){ 
                array_push($this->roomList, $room); //si no existe, lo agrego
            }  
        } else {
            array_push($this->roomList, $room); //si está vacío, lo agrego
        }
        $this->saveData(); //de cualquier modo guardo los datos
        if (!empty($flag)){ //flag no estaría vacía como resultado de la función existsByName, avisando que la sala ya existe
            $message = $flag;
        }
        else{
            $message = "";
        }
        return $message;
    }

    private function existsByName($name){
        foreach ($this->roomList as $room){
            if($room->getroomName() == $name) { //no puede haber dos salas con el mismo nombre
                    $message = "Room already registered";
                
            }
        }
        if (!isset($message)) { //salvoconducto por si $message no está seteada por fuera del foreach
            $message = ""; //como sí o sí le asigno un mensaje, por fuera tengo que corroborar con un !empty
        }
        return $message;
    }

   /* public function GetOne($roomId)
    {
        
            $this->RetrieveData();
            foreach($this->roomList as $room){
                if($room->getroomId() == $roomId){
                    return $room;
                }
            }

            return null;
    }

    public function Edit($roomId, room $roomModify)
    {
        $this->retrieveData();

        $PosOnList = null;
           
        foreach($this->roomList as $key => $room){
            if($room->getroomId() == $roomId){
                $PosOnList = $key;
            }
        }

        if($PosOnList != null || $PosOnList == 0){
            $this->roomList[$PosOnList] = $roomModify;
        }else
        {
            //echo "error";
        }
        //var_dump($roomModify);
        $this->SaveData();

        
    }*/


    public function retrieveData(){
        $this->roomList = array(); 
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $room = new Room();
                   // $room->setRoomId($valueArray['roomId']);
                    $room->setRoomName($valueArray['roomName']);
                    $room->setRoomCapacity($valueArray['roomCapacity']);
                    //$room->setIs3D($valueArray['Is3d']);
                    $room->setroomPrice($valueArray['roomPrice']);
                    array_push($this->roomList, $room);
                }
            }
        }
         
    }

    public function saveData(){
        $arrayToEncode = array();
        foreach($this->roomList as $room){
            
            $valueArray['roomId'] =  $room->getRoomId();
            $valueArray['roomName']= $room->getRoomName();
            $valueArray['roomCapacity'] = $room->getRoomCapacity();
            $valueArray['Is3D'] = $room->getIs3D();
            $valueArray['roomPrice'] = $room->getroomPrice();
    
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        //var_dump($this->filename);
        return file_put_contents($this->fileName, $jsonContent);

    }
}