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
                    $query = "INSERT INTO ".$this->tableName." (IdShow, Purchase, IdUser) 
                VALUES (:IdShow, :Purchase, :IdUser);";
                
                $parameters["IdShow"] = $ticket->getTicketShow()->getShowId();
                $parameters["Purchase"] = $ticket->getTicketPurchase();
                $parameters["IdUser"] = $ticket->getTicketUser()->getUserId();
                
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
                    $ticket->setTicketPurchase($row["TicketPurchase"]);
                    $ticket->setTicketUser($row["IdUser"]);
                    
                    array_push($TicketList, $ticket);
                }

                return $TicketList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function GetTicketsByShow($IdShow)
        {
           
            try
            {
                $ticketList = array();
               
                
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE IdShow = "' . $IdShow . '";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                   
                    $ticket = new Ticket();
                    $ticket->setTicketId("IdTicket");
                    $ticket->setTicketShow($row["IdShow"]);
                    $ticket->setTicketUser($row["IdUser"]);

                   
                    array_push($ticketList, $ticket);
                }
                //var_dump($ticketList);
                return $ticketList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    
    } 
    ?>