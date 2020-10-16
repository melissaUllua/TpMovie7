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
        require_once(VIEWS_PATHS."admin-list.php");
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