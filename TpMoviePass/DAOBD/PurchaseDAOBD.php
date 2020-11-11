<?php
    namespace DAOBD;

    use \Exception as Exception;
    use Models\Purchase as Purchase;
    use Models\CreditCard as CreditCard;       
    use DAOBD\Connection as Connection;

    /*
CREATE TABLE IF NOT EXISTS purchase	(IdPurchase int AUTO_INCREMENT,
										IdCard int not null,
										IdShow int not null,
                                        IdUser int not null,
                                        Seats int not null,
										FinalPrice float not null,
										CONSTRAINT pk_IdPurchase PRIMARY KEY (IdPurchase),
                                        CONSTRAINT fk_IdCard foreign key(IdCard) references creditCards(IdCard),
                                        CONSTRAINT fk_IdShow foreign key(IdShow) references Shows(IdShow)
										);
     */

    class PurchaseDAOBD 
    {
        private $connection;
        private $tableName = "Purchase";

        public function __construct()
        {
        }



        public function Add(Purchase $purchase, $idCreditCard)   //agrega un genero a la base de datos
        {
    
            $query = "INSERT INTO " . $this->tableName .
                " (IdShow, IdCard, Seats) VALUES
                    (:IdShow, :IdCard,:Seats);";

            $creditCard = new CreditCard();
            $creditCard = $purchase->getCreditCard();
            $parameters["IdShow"] = $purchase->getShow()->getShowId();
            
            $parameters["IdCard"] = $idCreditCard;
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

               
        /*
            Recibe un IdShow y devuelve true si existen compras con ese Id o false si no.
          
         */
        
        public function ExistsPurchaseByShow($idShow)
    {
        try
            {
                $query = "SELECT * FROM " . $this->tableName . " WHERE IdShow = ". $idShow .";";
                                
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


    }

