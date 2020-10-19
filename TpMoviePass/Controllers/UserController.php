<?php
namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

class UserController{
    private $userDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH."add-user.php");
    }

    public function ShowProfileView(){
        require_once(VIEWS_PATH."user-profile.php");
    }

    public function ShowLogInView($message = ""){
        require_once(VIEWS_PATH."logIn.php");
    }

    public function ShowLogOutView(){
        $this->LogOut();
       $this->ShowLogInView();
    }

    public function ShowSignUpView($message = ""){
        require_once(VIEWS_PATH."signUp.php");
    }
   
    public function signUp(){
        if($_POST)
        {
            $users = $this->userDAO->getAll();
            $user_aux = new User();                               //creo un user auxiliar para comparar
            $user_aux->setuserEmail($_POST['userEmail']);   
            $user_aux->setuserName($_POST['userName']);
           
            if ($users){ //verifico que haya datos para poder recorrerlo
                foreach ($users as $user){ //recorro el listado
                    if(($user_aux->getuserEmail() == $user->getuserEmail()) && ($user_aux->getuserPass() == $user->getuserPass()))
                    {
                        session_start();
            
                        $_SESSION["loggedUser"] = $user;
        
                    }
    
                }

            }
                
        }
    }

    public function LogIn(){
        if($_POST)
        {
            $users = $this->userDAO->getAll();
            $user_aux = new User();                               //creo un user auxiliar para comparar
            $user_aux->setuserEmail($_POST['userEmail']);   
            $user_aux->setuserPass($_POST['userPass']);
           
            if ($users){ //verifico que haya datos para poder recorrerlo
                foreach ($users as $user){ //recorro el listado
                    if(($user_aux->getuserEmail() == $user->getuserEmail()) && ($user_aux->getuserPass() == $user->getuserPass()))
                    {
                        session_start();
            
                        $_SESSION["loggedUser"] = $user;
        
                    }
    
                }

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


    public function Add($userName, $userPass, $userId, $isActive){
        $user = new user();
        $user->setuserName($userName);
        $user->setuserPass($userPass);
        $user->setuserId($userId);
        $user->setIsActive($isActive);

        $this->userDAO->Add($user);

        $this->ShowAddView(); //we should see if we keep this
    }

}


?>