<?php
namespace Controllers;

use DAO\AdminDAO as AdminDAO;
use Models\Admin as Admin;

class AdminController{
    private $adminDAO;

    public function __construct(){
        $this->adminDAO = new AdminDAO();
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH."add-admin.php");
    }

    public function ShowListView(){
        $adminList = $this->adminDAO->getAll();
        require_once(VIEWS_PATH."cinemas-list.php");
    }

    public function ShowLogInView($message = ""){
        require_once(VIEWS_PATH."logIn.php");
    }
    public function ShowLogOutView(){
        $this->LogOut();
        require_once(VIEWS_PATH."index.php");
    }

    public function LogIn(){
        if($_POST)
        {
            $admins = $this->adminDAO->getAll();
            $admin_aux = new Admin();                               //creo un admin auxiliar para comparar
            $admin_aux->setAdminEmail($_POST['adminEmail']);   
            $admin_aux->setAdminPass($_POST['adminPass']);
           
            if ($admins){ //verifico que haya datos para poder recorrerlo
                foreach ($admins as $admin){ //recorro el listado
                    if(($admin_aux->getAdminEmail() == $admin->getAdminEmail()) && ($admin_aux->getAdminPass() == $admin->getAdminPass()))
                    {
                        session_start();
            
                        $_SESSION["loggedUser"] = $admin; //dejo "loggedUser" porque la idea es tener otro tipo de usuario... pero no me convence
        
                    }
    
                }

            }
            
    
            
        }
    }

    public function LogInHC(){
        if($_POST)
        {
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";
    
            if(($email == "user@user.com") && ($password === "lala"))
            {
                $admin_aux = new Admin();
                $admin_aux->setAdminEmail($email);
                $admin_aux->setAdminPass($password);
    
                session_start();
    
                $_SESSION["loggedUser"] = $admin_aux;
    
               $this->ShowListView();
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

    public function signUp(){
        session_start();

    }

    public function Add($adminName, $adminPass, $adminId, $isActive){
        $admin = new Admin();
        $admin->setAdminName($adminName);
        $admin->setAdminPass($adminPass);
        $admin->setAdminId($adminId);
        $admin->setIsActive($isActive);

        $this->adminDAO->Add($admin);

        $this->ShowAddView(); //we should see if we keep this
    }

}


?>