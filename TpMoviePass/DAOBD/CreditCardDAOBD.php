<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\CreditCard as CreditCard; 
    use Models\User as User;      
    use DAOBD\Connection as Connection;
/*
CREATE TABLE IF NOT EXISTS creditCards(IdCard int AUTO_INCREMENT,
										IdUser int not null,
										CardOwner varchar (60) not null,
										CardNnumber varchar(16) not null,
                                        CardCvv varchar (3) not null,
                                        CardExpirationMonth varchar (2) not null,
                                        CardExpirationYear varchar (4) not null,
										CONSTRAINT pk_IdCard PRIMARY KEY (IdCard),
										CONSTRAINT fk_IdUser foreign key(IdUser) references Users(IdUser),
                                        CONSTRAINT unq_CardNumber unique (CardNnumber)
										);
 */
    class CreditCardDAOBD 
    {
        private $connection;
        private $tableName = "creditCards";

        public function __construct()
        {
        }



        public function Add(CreditCard $card)   //agrega una tarjeta de crédito a la base de datos
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
        /*
            Recibe un nro de tarjeta de crédito. Si ya existe en la base de datos, retorna el id de la tarjeta y si no existe, retorna '-1'
         */
        public function ExistsCardNumber($cardNumber)
        {
            try {
            $query = "SELECT * FROM " .$this->tableName . " WHERE CardNnumber = " .$cardNumber.";";

            $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                if ($resultSet){
                    $row = $resultSet[0];
                    $reply = $row['IdCard'];
                }
                else {
                    $reply = -1;
                }
                
                return $reply;
               
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
