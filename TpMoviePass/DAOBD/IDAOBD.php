<?php 

    namespace DAOBD;

    interface IDAOBD {

    function GetAll();
   // function GetAvailable(); //LAS FUNCIONES NO TIENEN AVAILABILITY
    function Add($object);
    //function Edit($object, $modification);
    function GetOneById($id); //esto va a ser que se nos rompa todo por las diferencias de nombres, pero para eso nos piden la interfaz
    //function GetOneByName($name); //tal vez no todas necesiten esto, pero la planteo

    }

?>