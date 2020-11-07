<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Room as Room;    
    use Models\Cinema as Cinema;    
    use DAOBD\Connection as Connection;
    use DAOBD\CinemaDAOBD as CinemaDAOBD;

    class RoomDAOBD 
    {
        private $connection;
        private $tableName = "Rooms";

        public function Add($room)
        {
            try
            {
               // var_dump($room);
                $query = "INSERT INTO ".$this->tableName." (IdCinema, RoomName, RoomCapacity, RoomIs3D, RoomPrice, RoomAvailability) 
                VALUES (:IdCinema, :RoomName, :RoomCapacity, :RoomIs3D, :RoomPrice, :RoomAvailability );";
                
                $parameters["IdCinema"] = $room->getRoomCinema()->getCinemaId();
                $parameters["RoomName"] = $room->getRoomName();
                $parameters["RoomCapacity"] = $room->getRoomCapacity();
                $parameters["RoomIs3D"] = $room->getIs3d();
                $parameters["RoomPrice"] = $room->getRoomPrice();
                $parameters["RoomAvailability"] = $room->getRoomAvailability();
               

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
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                   
                    $room = new Room();
                    $room->setRoomId($row["IdRoom"]);
                    $room->setRoomName($row["RoomName"]);
                    $room->setRoomCapacity($row["RoomCapacity"]);
                    $room->setIs3d($row["RoomIs3D"]);
                    $room->setRoomPrice($row["RoomPrice"]);
                    $room->setRoomAvailability($row["RoomAvailability"]);
                    ///falta agregar el cine


                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
        public function GetRoomByCinemas($cinemaID)
        {
           
            try
            {
                $roomList = array();
               
                
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE IdCinema = "' . $cinemaID . '";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                   
                    $room = new Room();
                    $room->setRoomId($row["IdRoom"]);
                    $room->setRoomName($row["RoomName"]);
                    $room->setRoomCapacity($row["RoomCapacity"]);
                    $room->setIs3D($row["RoomIs3D"]);
                    $room->setroomPrice($row["RoomPrice"]);
                    $room->setRoomAvailability($row["RoomAvailability"]);
                    $cinemaDao = new CinemaDAOBD();
                    $cinema = $cinemaDao->getOneCinema($row["IdCinema"]);
                    //var_dump($cinema);
                    $room->setRoomCinema($cinema);
                   
                    array_push($roomList, $room);
                }
                var_dump($roomList);
                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

       public function getAvailable($cinemaID)
        {
            try
            {
                $roomList = array();

                
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE RoomAvailability = "1" AND IdRoom = "' . $cinemaID .'";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $room = new Room();
                    $room->setRoomId($row["IdRoom"]);
                    $room->setRoomName($row["RoomName"]);
                    $room->setRoomCapacity($row["RoomCapacity"]);
                    $room->setIs3D($row["RoomIs3D"]);
                    $room->setroomPrice($row["RoomPrice"]);
                    $room->setRoomAvailability($row["RoomAvailability"]);

                    array_push($roomList, $room);
                    
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function getOneRoom($Id)
        {
            try
                {
                    $room = new Room();
                    $query = 'SELECT * FROM '.$this->tableName . ' WHERE IdRoom = "'. $Id .'";';
                    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);
                    
                    if($resultSet)
                    {         
                        $row = $resultSet[0];       
                        $room->setRoomId($row["IdRoom"]);
                        $room->setRoomName($row["RoomName"]);
                        $room->setRoomCapacity($row["RoomCapacity"]);
                        $room->setRoomAvailability($row["RoomAvailability"]);
                        $cinemaDao = new CinemaDAOBD();
                        $cinema = $cinemaDao->getOneCinema($row["IdCinema"]);
                        $room->setRoomCinema($cinema);
                        $room->setRoomAvailability($row["RoomAvailability"]);
                        $room->setroomPrice($row["RoomPrice"]);
                       
                    }
    
                    return $cinema;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }
    /*
    * Returns a Room
    */
            public function getOneRoomByName($roomName)
        {
            try
                {
                    $room = new Room();
                    $query = 'SELECT * FROM '.$this->tableName . ' WHERE RoomName = "'. $roomName .'";';
                    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);
                    
                    if($resultSet)
                    {         
                        $row = $resultSet[0];       
                        $room->setRoomId($row["IdRoom"]);
                        $room->setRoomName($row["RoomName"]);
                        $room->setRoomCapacity($row["RoomCapacity"]);
                        $room->setRoomAvailability($row["RoomAvailability"]);
                        $room->setRoomCinema($cinema);
                        $room->setRoomAvailability($row["RoomAvailability"]);
                        $room->setroomPrice($row["RoomPrice"]);
                       
                    }
    
                    return $room;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }
    
        }
    
    
    