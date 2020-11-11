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
                " (IdShow, IdCard, Seats) VALUES
                    (:IdShow, :IdCard,:Seats);";
                    var_dump($query);
            $parameters["IdShow"] = $purchase->getShow()->getShowId();
            $parameters["IdCard"] = $purchase->getCreditCard()->getIdCreditCard();
            $parameters["Seats"] = $purchase->getAmountOfSeats();
           // $parameters["FinalPrice"] = $card->getFinalPrice();
            //$parameters["IdUser"] = $card->getCardExpirationYear();
            

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (\Throwable $ex) {
    
                throw $ex;
            }
        }
       


    }

