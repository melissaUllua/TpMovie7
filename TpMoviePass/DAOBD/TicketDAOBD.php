<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Ticket as Ticket;    
    use DAOBD\Connection as Connection;

    //crear get by cine, verificacion de asientos disponibles,
    ///mostrar lista de asientos disponiblesxcine
    ///en bdd ticket x cines
    ///consulta

    class TicketDAOBD 
    {
        private $connection;
        private $tableName = "Tickets";

        public function Add(Ticket $ticket)
        {
            try
            { ///if con verificacion de asiento en la sala 
                    $query = "INSERT INTO ".$this->tableName." (IdShow, TicketSeatNumber) 
                VALUES (:IdShow, :TicketSeatNumber);";
                
                $parameters["IdShow"] = $ticket->getTicketShow();
                $parameters["TicketSeatNumber"] = $ticket->getTicketSeatNumber();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
                $message = ""; 
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
                $TicketList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $ticket = new Ticket();
                    $ticket->setTicketShow($row["IdShow"]);
                    $ticket->setTicketSeatNumber($row["TicketSeatNumber"]);
                    
                    array_push($TicketList, $ticket);
                }

                return $TicketList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function getAvailable() ///modificar para disponibles x show
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
    
    } 
    ?>