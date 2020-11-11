<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Room as Room;    
    use Models\Cinema as Cinema;    
    use DAOBD\Connection as Connection;
    use DAOBD\CinemaDAOBD as CinemaDAOBD;
    /*
    create table if not exists Rooms (IdRoom int not null auto_increment,
								IdCinema int not null,
								RoomName varchar(20) not null,
                                RoomCapacity int not null,
                                RoomIs3D boolean not null default true,
                                RoomPrice int not null,
                                RoomAvailability boolean not null,
                                CONSTRAINT pk_IdRoom primary key(IdRoom),
                                CONSTRAINT fk_IdCinema foreign key(IdCinema) references Cinemas(IdCinema),
								CONSTRAINT unq_roomName UNIQUE (RoomName, IdCinema)
);
     */

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
                    $cinema = new Cinema();
                    $cinema->setCinemaId($row["IdCinema"]);
                    $room->setRoomCinema($cinema);


                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
        /*
            Recibe un idCinema y retorna un listado de salas que correspondan con dicho id
         */
        public function GetRoomsByCinema($cinemaID)
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
                    $room->setRoomCinema($cinema);
                   
                    array_push($roomList, $room);
                }
                //var_dump($roomList);
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
                        $room->setIs3D($row["RoomIs3D"]);
                        $cinemaDao = new CinemaDAOBD();
                        $cinema = $cinemaDao->getOneCinema($row["IdCinema"]);
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

            public function Edit(Room $room, $idRoom)   //retorna 0 si pudo, 1 si hubo un error
            {
                $roomToModify = $this->getOneRoom($idRoom);   //trae la sala a modificar o null si no existe
            
                    if($roomToModify != null){
                        try{
                            $cinema = $roomToModify->getRoomCinema();
                            
                            $query =  ' UPDATE '.$this->tableName.' SET IdCinema = '.$cinema->getCinemaId().', RoomName = "'.$room->getRoomName().'", RoomCapacity= '.$room->getRoomCapacity().', RoomIs3D= '.$room->getIs3D().', RoomPrice= '.$room->getroomPrice().', RoomAvailability= '.$room->getRoomAvailability().'  WHERE IdRoom= "'.$idRoom.'";';
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
        
            }

            /*
        Recibe un nombre, un idCine y una idSala, trae todas los nombres que coincidan con el id del cine y no coincidan con el idSala.
        Retorna true si hay coincidencia o false si no la hay.
        Está pensada para el caso en el que el usuario planee cambiar la dirección de un cine, para validar que no exista en otro
 */
        public function checkNewName($name, $idCinema, $idRoom)
        {
            try
                {
                    $query = 'SELECT * FROM '.$this->tableName . ' WHERE RoomName = "'. $name .'" AND IdCinema = '.$idCinema.' AND IdRoom != '.$idRoom.';';
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
    

    /*
    * Returns true if finds any match, false if not.
    */
            public function ExistsRoomByName($roomName, $idCinema)
        {
            try
                {
                    $room = new Room();
                    $query = 'SELECT * FROM '. $this->tableName .' WHERE RoomName = "'. $roomName .'" AND IdCinema= '. $idCinema.';';
                    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);
                    
                    if(!empty($resultSet))
                    {         
                        $flag = true;
                       
                    } else {
                        $flag = false;
                    }
    
                    return $flag;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }
    

    
        
/*
        Recibe un IdCine y chequea en BDD de Room, si hay alguno con availability = 1 (true)
        Retorna true si hay coincidencia o false si no la hay.
        Esta función es para aplicar previo a la baja de un cine. No se pueden dar de baja cines con rooms disponibles.
 */
        public function checkRoomsAvailability($idCinema)
        {
            try
                {
                    $query = 'SELECT * FROM ' . $this->tableName . ' WHERE IdCinema = '.$idCinema.' AND RoomAvailability = 1;';
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

         
    }