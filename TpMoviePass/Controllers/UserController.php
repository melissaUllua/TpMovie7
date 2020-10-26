<?php
namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

class UserController{
    private $userDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
    }

    public function ShowProfileView(){
        require_once(VIEWS_PATH."user-profile.php");
    }

    public function ShowLogInView($message = ""){
        require_once(VIEWS_PATH."logIn.php");
    }

    public function ShowLogOutView(){
       $this->LogOut();
       header("Location: ". FRONT_ROOT . "index.php"); 
    }

    public function ShowSignUpView($message = ""){
        require_once(VIEWS_PATH."signUp.php");
    }
   
    public function signUp(){
        if($_POST)
        {
            $users = $this->userDAO->getAll();
            if(empty($users)){
                $this->AddSuperAdmin();
                $users = $this->userDAO->getAll();
            }          

                $user_aux = new User();                               
                $user_aux->setuserEmail($_POST['userEmail']);   
                $user_aux->setuserPass($_POST['userPass']);
                $user_aux->setuserName($_POST['userName']);
                $user_aux->setIsAdmin(0); //por defecto no va a ser admin- Business rules
                $user_aux->setIsActive(1); //por defecto no va a estar activo- Business rules             
              
                $message = $this->userDAO->Add($user_aux);
                if (empty($message)){
                    $this->ShowLogInView();
                } else {
                    $this->ShowSignUpView($message);
                }

            }
                
        }
    


    public function LogIn(){
        if($_POST)
        {   $this->AddSuperAdmin();
            $users = $this->userDAO->getAll();
            $user_aux = new User();                               //creo un user auxiliar para comparar  
            $user_aux->setuserPass($_POST['userPass']);
           
            $user_aux = $this->userDAO->searchByName($_POST['userName']); //searchbyName retorna un usuario
            if ($user_aux->getuserEmail()!= null){
                if ($user_aux->getuserPass() === $_POST['userPass']){
                    
                    $_SESSION['userName'] = $user_aux->getuserName();
                    $_SESSION['userEmail'] = $user_aux->getuserEmail();
                    $_SESSION['isAdmin'] = $user_aux->getIsAdmin();
                
                    $this->ShowProfileView();
                }

            }
             if (empty($_SESSION)) {
                    $message = "Usuario no encontrado";
                    $this->ShowLogInView($message);
                }

            
                
        }
    }

    public function LogInHC(){
        if($_POST)
        {
            $email = isset($_POST["userEmail"]) ? $_POST["userEmail"] : "";
            $password = isset($_POST["userPass"]) ? $_POST["userPass"] : "";
    
            if(($email == "user@user.com") && ($password === "lala"))
            {
                $user_aux = new User();
                $user_aux->setuserEmail($email);
                $user_aux->setuserPass($password);
                $user_aux->setuserName("User");
    
               // session_start(); //ya está en el index
    
                $_SESSION['userName'] = $user_aux->getuserName();
                $_SESSION['isAdmin'] = $user_aux->getIsAdmin();
    
               $this->ShowProfileView();
            }
            else {
                $message = "Usuario no encontrado";
                $this->ShowLogInView($message);
            }        
                
    }
}

    public function LogOut(){
        //session_start();
        session_destroy();
    }

       public function AddSuperAdmin(){
        $user = new User();
        $user->setuserName("SuperAdmin");
        $user->setuserEmail("user@user.com");
        $user->setuserPass("123");
        $user->setuserId(0);
        $user->setIsActive(1);
        $user->setIsAdmin(1);

        $this->userDAO->Add($user);
    }

    private function verifyPass($pass){
        $pass_aux = null;
        if(strlen($pass)>=3){ //retorna la longitud del string en int- pongo 3 para no trabajar con valores muy grandes
            $array = str_split($pass);
        }
    }

}


?>