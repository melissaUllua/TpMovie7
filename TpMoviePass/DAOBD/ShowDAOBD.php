<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Show as Show;    
    use DAOBD\Connection as Connection;
    use DAOBD\MovieDAOBD as MovieDAOBD;
    use DAOBD\RoomDAOBD as RoomDAOBD;
    use DAOBD\CinemaDAOBD as CinemaDAOBD;

   /*create table if not exists  Shows(
        IdShow int auto_increment,
        IdMovie int not null,
	    IdRoom int not null,
        ShowDate varchar(10) not null,
        ShowTime varchar(5) not null,
        constraint pk_show PRIMARY KEY(IdShow),
        constraint pfk_show_idMovie FOREIGN KEY(IdMovie) REFERENCES Movies(IdMovie) ON DELETE CASCADE ON UPDATE CASCADE,
        constraint pfk_show_idRoom FOREIGN KEY(IdRoom) REFERENCES Rooms(IdRoom) ON DELETE CASCADE ON UPDATE CASCADE

    );
     //siendo ShowDate "d.m.y" y ShowTime "00:00"
*/
    class ShowDAOBD implements IDAOBD
    {
        private $connection;
        private $tableName = "Shows";

        public function Add($show)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (IdMovie, ShowDate, ShowTime, IdRoom) 
                VALUES (:IdMovie, :ShowDate, :ShowTime, :IdRoom);";
                
                $parameters["ShowDate"] = $show->getShowDate();
                $parameters["ShowTime"] = $show->getShowTime();
                $parameters["IdRoom"] = $show->getShowRoom()->getroomId();
                $parameters["IdMovie"] = $show->getShowMovie()->getId();
                

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return $message = "Show added successfully";
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
                $showList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $movie_aux = new MovieDAOBD();
                $room_aux = new RoomDAOBD();
                $cinema_aux = new CinemaDAOBD();

                foreach ($resultSet as $row)
                {                
                    $show = new Show();
                    $show->setShowId($row["IdShow"]);
                    $show->setShowMovie($movie_aux->searchById($row["IdMovie"]));
                    $room = $room_aux->getOneRoom($row["IdRoom"]);
                    $room->setRoomCinema($cinema_aux->getOneCinema($room->getRoomCinema()->getCinemaId()));
                    $show->setShowRoom($room);
                    $show->setShowDate($row["ShowDate"]);
                    $show->setShowTime($row["ShowTime"]);

                    array_push($showList, $show);
                }

                return $showList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
       
        public function GetOneById($showID)
        {
            try
            {

                $query = 'SELECT * FROM '.$this->tableName . ' WHERE Idshow =' . "$showID";

                $oneshow = $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                $movie_aux = new MovieDAOBD();
                $room_aux = new RoomDAOBD();
                if ($resultSet)
                {                
                    $row = $resultSet['0'];
                    $show = new Show();
                    $show->setShowId($row["IdShow"]);
                    $movieDao = new MovieDAOBD();
                    $movie = $movieDao->searchById($row["IdMovie"]);
                    $show->setShowMovie($movie);
                    $show->setShowDate($row["ShowDate"]);
                    $show->setShowTime($row["ShowTime"]);
                    $cinemaDao = new CinemaDAOBD();
                    $cinema = $cinemaDao->getOneCinema($rom["IdCinema"]);
                    $show->setShowCinema($cinema);
                    

                    array_push($oneshow, $show);
                }

                return $showList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        

      
    }
?>