<?php
namespace DAO;

use Models\Cinema as Cinema; 

class CinemaDAO implements IDAO{
    private $cinemaList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = dirname(__DIR__) . "/Data/Cinema.json";
        

    }

    public function getAll(){
        $this->retrieveData();
        return $this->cinemaList;
    }

    /**
     * Retrieves all and filters according to availability
     *
     * @return  availableCinemasList
     */ 
    public function getAvailable(){
        $this->retrieveData();
        return $this->cinemaList;
    }

    public function Add($cinema){
        $this->retrieveData();
        array_push($this->cinemaList, $cinema);
        $this->saveData();
    }
    public function GetOne($CinemaId)
    {
        
            $this->RetrieveData();
            foreach($this->cinemaList as $cinema){
                if($cinema->getCinemaId() == $CinemaId){
                    return $cinema;
                }
            }

            return null;
    }

    public function Edit($CinemaId, Cinema $cinemaModify)
    {
        $this->retrieveData();

        $PosOnList = null;
           
        foreach($this->cinemaList as $key => $cinema){
            if($cinema->getCinemaId() == $CinemaId){
                $PosOnList = $key;
            }
        }

        if($PosOnList != null || $PosOnList == 0){
            $this->cinemaList[$PosOnList] = $cinemaModify;
        }else
        {
            //echo "error";
        }
        //var_dump($cinemaModify);
        $this->SaveData();

        
    }


    public function retrieveData(){
        $this->cinemaList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $cinema = new Cinema();
                    $cinema->setCinemaId($valueArray['cinemaId']);
                    $cinema->setCinemaName($valueArray['cinemaName']);
                    $cinema->setCinemaTotalCapacity($valueArray['cinemaTotalCapacity']);
                    $cinema->setCinemaTicketPrice($valueArray['cinemaTicketPrice']);
                    $cinema->setCinemaAddress($valueArray['cinemaAddress']);
                    $cinema->setCinemaAvailability($valueArray['cinemaAvailability']);
                    array_push($this->cinemaList, $cinema);
                }
            }
        }
         
    }

    public function saveData(){
        $arrayToEncode = array();
        foreach($this->cinemaList as $cinema){
            
            $valueArray['cinemaId'] =  $cinema->getCinemaId();
            $valueArray['cinemaName']= $cinema->getCinemaName();
            $valueArray['cinemaTotalCapacity'] = $cinema->getCinemaTotalCapacity();
            $valueArray['cinemaTicketPrice'] = $cinema->getCinemaTicketPrice();
            $valueArray['cinemaAddress'] = $cinema->getCinemaAddress();
            $valueArray['cinemaAvailability'] = $cinema->getCinemaAvailability();
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        //var_dump($this->filename);
        return file_put_contents($this->fileName, $jsonContent);

    }
}