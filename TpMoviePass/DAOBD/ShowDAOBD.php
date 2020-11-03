<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Show as Show;    
    use DAOBD\Connection as Connection;
    use DAOBD\MovieDAOBD as MovieDAOBD;
    use DAOBD\RoomDAOBD as RoomDAOBD;

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
                $query = "INSERT INTO ".$this->tableName." (ShowDate, ShowTime, IdRoom, IdMovie) 
                VALUES (:showDate,:showTime, :idRoom, :idMovie);";
                
                $parameters["showDate"] = $show->getShowDate();
                $parameters["showTime"] = $show->getShowTime();
                $parameters["idRoom"] = $show->getShowRoom()->getroomId();
                $movie = $show->getShowMovie();
                $id = $movie->getId();

                $parameters["idMovie"] = $id;
                

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

                foreach ($resultSet as $row)
                {                
                    $show = new show();
                    $show->setShowId($row["IdShow"]);
                    $show->setShowMovie($movie_aux->searchById($row["IdMovie"]));
                    //$show->setShowRoom($room_aux->searchById($row["IdRoom"]));
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
                    $show->setShowMovie($movie_aux->searchById($row["IdMovie"]));
                    //$show->setShowRoom($room_aux->getOneById($row["IdRoom"]));
                    $show->setShowDate($row["ShowDate"]);
                    $show->setShowTime($row["ShowTime"]);
                    

                    array_push($oneshow, $show);
                }

                return $showList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        

        public function Editshow($show)
        {
            ///getOne y luego alter table
        }
    }
?>