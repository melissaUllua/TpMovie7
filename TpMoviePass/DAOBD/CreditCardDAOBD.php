<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\CreditCard as CreditCard; 
    use Models\User as User;      
    use DAOBD\Connection as Connection;

    class CreditCardDAOBD 
    {
        private $connection;
        private $tableName = "creditCards";

        public function __construct()
        {
        }



        public function Add(CreditCard $card)   //agrega un genero a la base de datos
        {
           
            
            $query = "INSERT INTO " . $this->tableName .
                " (CardOwner, CardNnumber, CardCvv, CardExpirationMonth, CardExpirationYear) VALUES
                    (:CardOwner, :CardNnumber,:CardCvv, :CardExpirationMonth, :CardExpirationYear);";
                    var_dump($query);
            $parameters["CardOwner"] = $card->getCardOwner();
            $parameters["CardNnumber"] = $card->getCardNumber();
            $parameters["CardCvv"] = $card->getCardCvv();
            $parameters["CardExpirationMonth"] = $card->getCardExpirationMonth();
            $parameters["CardExpirationYear"] = $card->getCardExpirationYear();
            //$parameters["IdUser"] = $card->getCardExpirationYear();
            

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
             
            } catch (\Throwable $ex) {
    
                throw $ex;
            }
        
       
        }
        public function ExistsCardNumber($cardNumber)
        {
            try {
            $query = "SELECT * FROM " .$this->tableName . " WHERE CardNnumber = " .$cardNumber.";";

            $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                //var_dump($resultSet);
                return $resultSet;
               
            } catch (\Throwable $th) {
                throw $th;
            }
            
        }
        public function CardsByUser($userId)
        {
            $this->CreditCardsList = array();
            $query = "SELECT IdCard FROM cards_by_users WHERE IdUser = " . $userId . ";";
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {

                    $card = new CreditCard();

                    $movie = $this->searchById($row['IdCard']);
    
                    array_push($this->CreditCardsList, $card);
                }

                return $this->CreditCardsList;

            } catch (\Throwable $th) {
                throw $th;
            }
        }

    }
