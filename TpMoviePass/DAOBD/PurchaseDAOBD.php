<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Purchase as Purchase;    
    use DAOBD\Connection as Connection;

    class PurchaseDAOBD 
    {
        private $connection;
        private $tableName = "Purchase";

        public function __construct()
        {
        }



        public function Add(Purchase $purchase)   //agrega un genero a la base de datos
        {
    
            $query = "INSERT INTO " . $this->tableName .
                " (IdShow, CardNnumber, Seats, FinalPrice) VALUES
                    (:IdShow, :CardNnumber,:Seats, :FinalPrice);";
                    var_dump($query);
            $parameters["IdShow"] = $card->getShow()->getShowId();
            $parameters["CardNnumber"] = $card->getCreditCard()->getCardNumber();
            $parameters["Seats"] = $card->getAmountOfSeats();
            $parameters["FinalPrice"] = $card->getFinalPrice();
            //$parameters["IdUser"] = $card->getCardExpirationYear();
            

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (\Throwable $ex) {
    
                throw $ex;
            }
        }
        public function Exists(CreditCard $card)
        {
            try {
            $query = "SELECT * FROM " .$this->tableName . " WHERE CardNumber = " .$card->getCardNumber().";";

            $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                //var_dump($resultSet);
               
                return $resultSet;
            } catch (\Throwable $th) {
                throw $th;
            }
        }


    }

