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
        if($this->userList){
            $flag = $this->existsByName($user->getuserName(), $user->getuserEmail());
            if (empty($flag)){
                array_push($this->userList, $user);
            }  
        } else {
            array_push($this->userList, $user);
        }
        $this->saveData();
        if (!empty($flag)){
            $message = $flag;
        }
        else{
            $message = "";
        }
        return $message;
    }

    private function existsByName($name, $email){
        foreach ($this->userList as $user_aux){
            if(($user_aux->getuserEmail() == $email) || ($user_aux->getuserName() == $name))
                {
                    $message = "El usuario ya existe";
                }
        }
        if (!isset($message)) {
            $message = "";
        }
        return $message;
    }

    public function searchByName(){
        
    }

    private function retrieveData(){
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

    private function saveData(){
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