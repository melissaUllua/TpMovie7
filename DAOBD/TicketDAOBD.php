<?php
    namespace DAOBD;

    use \Exception as Exception;
    use \PDOException as PDOException;
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
            $message = ""; 
            try
            { ///if con verificacion de asiento en la sala 
                    $query = "INSERT INTO ".$this->tableName." (IdShow, TicketSeatNumber) 
                VALUES (:IdShow, :TicketSeatNumber);";
                
                $parameters["IdShow"] = $ticket->getTicketShow();
                $parameters["TicketSeatNumber"] = $ticket->getTicketSeatNumber();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);               
    
            }
            catch(PDOException $pdoE){
                throw $pdoE;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally{
                 return $message;
            }
        }

        public function GetAll()
        {
            $TicketList = array();
            try
            {  
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

                
            }
            catch(PDOException $pdoE){
                throw $pdoE;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally{
                return $TicketList;
            }
        }
        public function getAvailable() ///modificar para disponibles x show
        {
            $cinemaList = array();
            try
            {                
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
            }
            catch(PDOException $pdoE){
                throw $pdoE;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                return $cinemaList;
            }
        }
    
    } 
    ?>