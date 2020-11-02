<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Room as Room;    
    use DAOBD\Connection as Connection;

    class RoomDAOBD 
    {
        private $connection;
        private $tableName = "Rooms";

        public function Add(Room $room)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (RoomName, RoomCapacity, RoomIs3D, RoomPrice, RoomAvailability) 
                VALUES ( :RoomName, :RoomCapacity, :RoomIs3D, :RoomPrice, :RoomAvailability );";
                
               // $parameters["IdCinema"] = $room->getRoomCinemaID();
                $parameters["RoomName"] = $room->getRoomName();
                $parameters["RoomCapacity"] = $room->getRoomCapacity();
                $parameters["RoomIs3D"] = $room->getRoomIs3d();
                $parameters["RoomPrice"] = $room->getRoomPrice();
                $parameters["RoomAvailability"] = $room->getRoomAvailability();
                var_dump($room->getRoomIs3d());

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
                    $room->setRoomName($row["RoomName"]);
                    $room->setRoomCapacity($row["RoomCapacity"]);
                    $room->setRoomIs3d($row["RoomIs3D"]);
                    $room->setRoomPrice($row["RoomPrice"]);
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
        public function getAvailable()
        {
            try
            {
                $roomList = array();

                
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE cinemaAvailability = "1";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                   
                    $room = new Room();
                    $room->setRoomName($row["RoomName"]);
                    $room->setRoomCapacity($row["RoomCapacity"]);
                    $room->setRoomIs3d($row["RoomIs3D"]);
                    $room->setRoomPrice($row["RoomPrice"]);
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
    }
    
    