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
        require_once(VIEWS_PATH."admin-list.php");
    }

    public function ShowLogInView(){
        require_once(VIEWS_PATH."logIn.php");
    }
    public function ShowLogOutView(){ //I don't like it... this should link to the HomePage
        require_once(VIEWS_PATH."logOut.php");
    }

    public function LogIn(){
        if (isset $_POST)
        session_start();
    }

    public function LogOut(){
        session_start();

        session_destroy();
    
        $this->ShowLogOutView();
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