<?php
namespace DAO;

use Models\User as User; 

class UserDAO implements IDAO{
    private $userList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = str_replace("\\", "/", dirname(__DIR__)) . "/Data/Users.json";
        
    }

    public function getAll(){
        $this->retrieveData();
        return $this->userList;
    }

    public function getAvailable(){
        $this->retrieveData();
        return $this->userList;
    }

    public function Add($user){
        $this->retrieveData();
        $flag;
        if($this->userList){
            foreach ($this->userList as $user_aux){
                if(($user_aux->getuserEmail() == $user->getuserEmail()) || ($user_aux->getuserName() == $user->getuserName()))
                    {
                        $flag = "El usuario ya existe";
                    }
            }
        }
        if (!isset($flag)){
            array_push($this->userList, $user);
        }    
        
        $this->saveData();
    }

    public function retrieveData(){
        $this->userList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $user = new User();
                    $user->setuserName($valueArray['userName']);
                    $user->setuserPass($valueArray['userPass']);
                    $user->setuserId($valueArray['userId']);
                    $user->setIsActive($valueArray['isActive']); //We should discuss how are we going to handle this
                    $user->setuserEmail($valueArray['userEmail']);
                    $user->setIsAdmin($valueArray['isAdmin']);
                    
                    array_push($this->userList, $user);
                }
            }
        }
         
    }

    public function saveData(){
        $arrayToEncode = array();
        foreach($this->userList as $user){
            
            $valueArray['userName'] =  $user->getuserName();
            $valueArray['userPass']= $user->getuserPass();
            $valueArray['userId'] = $user->getuserId();
            $valueArray['isActive'] = $user->getIsActive();
            $valueArray['userEmail'] = $user->getuserEmail();
            $valueArray['isAdmin'] = $user->getIsAdmin();
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);

    }
}