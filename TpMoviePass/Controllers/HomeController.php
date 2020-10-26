<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "") //in case I want to display a message to the user
        {
            require_once(VIEWS_PATH."movies-list.php");

        }        
    }
?>