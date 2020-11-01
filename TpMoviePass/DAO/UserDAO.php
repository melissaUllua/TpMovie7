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
        $this->retrieveActiveData();
        return $this->userList;
    }

    public function getAdmins(){
        $this->retrieveAdminData();
        return $this->userList;
    }

    public function getNonAdmins(){
        $this->retrieveNonAdminData();
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
                    $message = "User already exists";
                }
        }
        if (!isset($message)) {
            $message = "";
        }
        return $message;
    }

    public function searchByName($name){
        $user = new User();
        $user->setuserName($name);
        foreach ($this->userList as $user_aux){
            if($user_aux->getuserName() == $user->getuserName())
                {
                    $user = $user_aux;
                }
        }
        return $user;
    }

    public function searchByEmail($email){
        $user = new User();
        $user->setuserEmail($email);
        foreach ($this->userList as $user_aux){
            if($user_aux->getuserEmail() == $user->getuserEmail())
                {
                    $user = $user_aux;
                }
        }
        return $user;
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
                    $user->setuserFirstName($valueArray['userFirstName']);
                    $user->setuserLastName($valueArray['userLastName']);
                    
                    array_push($this->userList, $user);
                }
            }
        }
         
    }

    private function retrieveAdminData(){
        $this->userList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    if ($valueArray['isAdmin'] == 1) {
                    $user = new User();
                    $user->setuserName($valueArray['userName']);
                    $user->setuserPass($valueArray['userPass']);
                    $user->setuserId($valueArray['userId']);
                    $user->setIsActive($valueArray['isActive']); //We should discuss how are we going to handle this
                    $user->setuserEmail($valueArray['userEmail']);
                    $user->setIsAdmin($valueArray['isAdmin']);
                    $user->setuserFirstName($valueArray['userFirstName']);
                    $user->setuserLastName($valueArray['userLastName']);
                    array_push($this->userList, $user);

                    }
                    
                }
            }
        }
         
    }

    private function retrieveNonAdminData(){
        $this->userList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    if ($valueArray['isAdmin'] == 0) {
                    $user = new User();
                    $user->setuserName($valueArray['userName']);
                    $user->setuserPass($valueArray['userPass']);
                    $user->setuserId($valueArray['userId']);
                    $user->setIsActive($valueArray['isActive']); //We should discuss how are we going to handle this
                    $user->setuserEmail($valueArray['userEmail']);
                    $user->setIsAdmin($valueArray['isAdmin']);
                    $user->setuserFirstName($valueArray['userFirstName']);
                    $user->setuserLastName($valueArray['userLastName']);
                    
                    array_push($this->userList, $user);

                    }
                    
                }
            }
        }
         
    }

    private function retrieveActiveData(){
        $this->userList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    if ($valueArray['isActive'] == 1) {
                    $user = new User();
                    $user->setuserName($valueArray['userName']);
                    $user->setuserPass($valueArray['userPass']);
                    $user->setuserId($valueArray['userId']);
                    $user->setIsActive($valueArray['isActive']);
                    $user->setuserEmail($valueArray['userEmail']);
                    $user->setIsAdmin($valueArray['isAdmin']);
                    $user->setuserFirstName($valueArray['userFirstName']);
                    $user->setuserLastName($valueArray['userLastName']);
                    
                    array_push($this->userList, $user);

                    }
                    
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
            $valueArray['userFirstName'] = $user->getuserFirstName();
            $valueArray['userLastName'] = $user->getuserLastName();
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);

    }
}