<?php
namespace DAO;

use Models\Rooms as Room; 

class RoomsDAO implements IDAO{
    private $roomsList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = dirname(__DIR__) . "/Data/Rooms.json";
    }

    public function getAll(){
        $this->retrieveData();
        return $this->roomsList;
    }

    /**
     * Retrieves all and filters according to availability
     *
     * @return  availableroomsList
     */ 
    public function getAvailable(){
        $this->retrieveData();
        return $this->roomsList;
    }

    public function Add($room){
        $this->retrieveData();
        array_push($this->roomsList, $room);
        $this->saveData();
    }
   /* public function GetOne($roomId)
    {
        
            $this->RetrieveData();
            foreach($this->roomsList as $room){
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
           
        foreach($this->roomsList as $key => $room){
            if($room->getroomId() == $roomId){
                $PosOnList = $key;
            }
        }

        if($PosOnList != null || $PosOnList == 0){
            $this->roomsList[$PosOnList] = $roomModify;
        }else
        {
            //echo "error";
        }
        //var_dump($roomModify);
        $this->SaveData();

        
    }*/


    public function retrieveData(){
        $this->roomsList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $rooms = new Room();
                    $rooms->setRoomId($valueArray['roomId']);
                    $rooms->setRoomName($valueArray['roomName']);
                    $rooms->setRoomCapacity($valueArray['roomCapacity']);
                    $rooms->setRoom3d($valueArray['roomIs3D']);
                    $rooms->setRoomPrice($valueArray['roomPrice']);
                    array_push($this->roomsList, $room);
                }
            }
        }
         
    }

    public function saveData(){
        $arrayToEncode = array();
        foreach($this->roomsList as $room){
            
            $valueArray['roomId'] =  $room->getRoomId();
            $valueArray['roomName']= $room->getRoomName();
            $valueArray['roomCapacity'] = $room->getRoomCapacity();
            $valueArray['roomIs3D'] = $room->getRoom3d();
            $valueArray['roomPrice'] = $room->getRoomPrice();
    
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        //var_dump($this->filename);
        return file_put_contents($this->fileName, $jsonContent);

    }
}