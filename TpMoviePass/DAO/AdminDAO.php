<?php
namespace DAO;

//use Models\Admin as Admin; 

class AdminDAO implements IDAO{
    private $adminList = array();
    private $fileName;

    public function __contruct(){
        $this->fileName = str_replace("\\", "/", dirname(__DIR__)) . "/Data/admins.json";
    }

    public function getAll(){
        $this->retrieveData();
        return $this->adminList;
    }

    public function getAvailable(){
        $this->retrieveData();
        return $this->adminList;
    }

    public function Add($admin){
        $this->retrieveData();
        array_push($this->adminList, $admin);
        $this->saveData();
    }

    public function retrieveData(){
        $this->adminList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $admin = new Admin();
                    $admin->setAdminName($valueArray['adminName']);
                    $admin->setAdminPass($valueArray['adminPass']);
                    $admin->setAdminId($valueArray['adminId']);
                    $admin->setIsActive($valueArray['isActive']); //We should discuss how are we going to handle this
                    array_push($this->adminList, $admin);
                }
            }
        }
         
    }

    public function saveData(){
        $arrayToEncode = array();
        foreach($this->adminList as $admin){
            
            $valueArray['adminName'] =  $admin->getAdminName();
            $valueArray['adminPass']= $admin->getAdminPass();
            $valueArray['adminId'] = $admin->getAdminId();
            $valueArray['isActive'] = $admin->getIsActive();
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);

    }
}