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
                $query = "INSERT INTO ".$this->tableName." (cinemaName, cinemaAddress, cinemaAvailability) 
                VALUES (:CinemaAddress, :CinemaAddress, :CinemaAvailability);";
                
                //$parameters["recordId"] = $cinema->getRecordId();
                $parameters["CinemaName"] = $cinema->getCinemaName();
                $parameters["CinemaAddress"] = $cinema->getCinemaAddress();
                $parameters["CinemaAvailability"] = $cinema->getCinemaAvailability();
                //$parameters["cinemaTotalRooms"] = $cinema->getcinemaTotalRooms();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
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
                    //$cinema->setRecordId($row["recordId"]);
                    $cinema->setCinemaName($row["cinemaName"]);
                    $cinema->setCinemaAddress($row["cinemaAddress"]);
                    $cinema->setCinemaAvailability($row["cinemaAvailability"]);
                    

                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>