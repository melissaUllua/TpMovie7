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
                if ($flag == false){
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
                    $cinema->setCinemaId($row["IdCinema"]);
                    $cinema->setCinemaName($row["CinemaName"]);
                    $cinema->setCinemaAddress($row["CinemaAddress"]);
                    $cinema->setCinemaAvailability($row["CinemaAvailability"]);
                    

                   
                }

                return $cinema;
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
                $flag = false;
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE CinemaAddress = "'. $address .'";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if($resultSet)
                {                
                   $flag = true;
                   
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

        public function EditCinema($cinema)
        {
            ///getOne y luego alter table
        }
    }
?>