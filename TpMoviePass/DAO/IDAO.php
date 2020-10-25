<?php //I don't see the poin    t

    namespace DAO;

    interface IDAO {

    function getAll();
    function getAvailable(); //not sure wether to use different lists, or only one... or even if we should create an alternative function (see comment below)
    function Add($object); //here I should send an object...
    //function searchByName($name, $list, $message = "");

    //function retrieveAvailable(); //function retrieveFiltered();
    }

?>