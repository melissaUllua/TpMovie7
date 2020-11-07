<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Cinema as Cinema;    
    use DAOBD\Connection as Connection;

    class CinemaDAOBD 
    {
        private $connection;
        private $tableName = "Cinemas";

        public function Add(Cinema $cinema)
        {
            try
            {
                $flag = $this->ExistsCinemaByAddress($cinema->getCinemaAddress());
                if ($flag == null){
                    $query = "INSERT INTO ".$this->tableName." (cinemaName, cinemaAddress, cinemaAvailability) 
                VALUES (:CinemaName, :CinemaAddress, :CinemaAvailability);";
                
                $parameters["CinemaName"] = $cinema->getCinemaName();
                $parameters["CinemaAddress"] = $cinema->getCinemaAddress();
                $parameters["CinemaAvailability"] = $cinema->getCinemaAvailability();
                //$parameters["cinemaTotalRooms"] = $cinema->getcinemaTotalRooms();
            
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
                $message = ""; 

                }
                else {
                    $message = "There already exists a Cinema in that address";
                }
                
                return $message;
    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $cinemaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
                    $cinema->setCinemaId($row["IdCinema"]);
                    $cinema->setCinemaName($row["CinemaName"]);
                    $cinema->setCinemaAddress($row["CinemaAddress"]);
                    $cinema->setCinemaAvailability($row["CinemaAvailability"]);
                    
                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function getAvailable()
        {
            try
            {
                $cinemaList = array();

                
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE cinemaAvailability = "1";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
                    $cinema->setCinemaId($row["IdCinema"]);
                    $cinema->setCinemaName($row["CinemaName"]);
                    $cinema->setCinemaAddress($row["CinemaAddress"]);
                    $cinema->setCinemaAvailability($row["CinemaAvailability"]);
                    

                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
    
    public function getOneCinema($Id)
    {
        try
            {
                $cinema = new Cinema();
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE IdCinema = "'. $Id .'";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if($resultSet)
                {         
                    $row = $resultSet[0];       
                    $cinema->setCinemaId($row["IdCinema"]);
                    $cinema->setCinemaName($row["CinemaName"]);
                    $cinema->setCinemaAddress($row["CinemaAddress"]);
                    $cinema->setCinemaAvailability($row["CinemaAvailability"]);
                    return $cinema;


                   
                }else{
                    return null;
                }

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    public function ExistsCinemaByAddress($address)
    {
        try
            {
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE CinemaAddress = "'. $address .'";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if($resultSet)
                {                
                    $flag = true;
                }
                else {
                    $flag = false;
                }
                return $flag;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
       /* public function getLastID() 
        {
            try
            {
                $cinemaList = array();
                
                //$query = ' SELECT * FROM ' .$this->tableName . 'ORDER BY IdCinema DESC LIMIT 1;';
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
                    $cinema->setCinemaId($row["IdCinema"]);
                    $cinema->setCinemaName($row["CinemaName"]);
                    $cinema->setCinemaAddress($row["CinemaAddress"]);
                    $cinema->setCinemaAvailability($row["CinemaAvailability"]);
                    
                    array_push($cinemaList, $cinema);
                }
                var_dump($cinemaList);
                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }*/

        public function EditCinema(Cinema $cinema, $idCinema)   //retorna 0 si pudo, 1 si hubo un error, 2 si el address ya existe
        {
            $cinemaToModify = $this->getOneCinema($idCinema);   //trae el cine a modificar o null si no existe

            $addressValidation = $this->ExistsCinemaByAddress($cinemaToModify->getCinemaAddress());

            if($addressValidation == false){
                if($cinemaToModify != null){
                    try{
                        
                        $query =  ' UPDATE '.$this->tableName.' SET CinemaName = "'.$cinema->getCinemaName().'", CinemaAddress = "'.$cinema->getCinemaAddress().'", CinemaAvailability = "'.$cinema->getCinemaAvailability().'" WHERE IdCinema= "'.$idCinema.'";';
                        $this->connection = Connection::GetInstance();
                        $this->connection->ExecuteNonQuery($query);
                        return 0;
                    }
            
                    catch(Exception $ex){
                        throw $ex;
                    } 
    
                }else{
                    return 1;
                }

            }else{

                return 2;
            }

 
        }


    }
    
?>