<?php
    namespace DAOBD;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use Models\Purchase as Purchase;
    use Models\User as User;
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
                " (IdShow, IdCard, Seats, FinalPrice) VALUES
                    (:IdShow, :IdCard,:Seats, :FinalPrice);";

            $creditCard = new CreditCard();
            $creditCard = $purchase->getCreditCard();
            $parameters["IdShow"] = $purchase->getShow()->getShowId();
            
            $parameters["IdCard"] = $idCreditCard;
            $parameters["Seats"] = $purchase->getAmountOfSeats();
            $parameters["FinalPrice"] = $purchase->getFinalPrice();
           // $parameters["FinalPrice"] = $card->getFinalPrice();
            //$parameters["IdUser"] = $card->getCardExpirationYear();
            

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(PDOException $pdoE){
                throw $pdoE;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

               
        /*
            Recibe un IdShow y devuelve true si existen compras con ese Id o false si no.
          
         */
        
        public function ExistsPurchaseByShow($idShow)
    {
        $flag = null;
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
            }
            catch(PDOException $pdoE){
                throw $pdoE;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally {
                return $flag;
            }
        }
        public function GetPurchasesTotalIncome($IdShow)
        {
           
            try
            {
                $purchaseList = array();
                $totalSeats = null;
               
                ///funciona bien, necesito ver como pasarlo a una sola variable
                $query = 'SELECT SUM(seats) as totalSeats FROM '.$this->tableName . ' WHERE IdShow = "' . $IdShow . '";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {                
                   ///no se hace así, pero no estoy segura de como se hace tampoco
                    $totalSeats = $resultSet();
                   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function GetPurchasesByUser($IdUser) ///no la probé pero debería funcionar
        {
           
            try
            {
                $purchaseList = array();
               
                $query = 'SELECT * FROM '.$this->tableName . ' WHERE IdUser = "' . $IdUser . '";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {
    
                   $purchase = new Purchase();
                   $purchase->setIdPurchase($row["IdPurchase"]);
                   $purchase->setShow()->setShowId($row["IdShow"]);
                   $purchase->setUser($row["IdUser"]);
                   $purchase->setAmountOfSeats($row["Seats"]);
                   $purchase->setCreditCard()->setIdCreditCard($row["IdCard"]);
                   $purchase->setFinalPrice($row["FinalPrice"]);
    
                    array_push($this->purchaseList, $purchase);
                }
            }
            catch(PDOException $pdoE){
                throw $pdoE;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally {
                return $this->purchaseList;
            }
        }
        public function GetPurchasesByMovies($IdMovie)
        {
           
            try
            {
                $purchaseList = array();
               /// pensé en hacer esta query con una subquery, pero todavía es medio dudoso
                ///$query = 'SELECT * FROM '.$this->tableName . ' WHERE IdUser = "' . $IdUser . '";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {
    
                   $purchase = new Purchase();
                   $purchase->setIdPurchase($row["IdPurchase"]);
                   $purchase->setShow()->setShowId($row["IdShow"]);
                   $purchase->setUser($row["IdUser"]);
                   $purchase->setAmountOfSeats($row["Seats"]);
                   $purchase->setCreditCard()->setIdCreditCard($row["IdCard"]);
                   $purchase->setFinalPrice($row["FinalPrice"]);
    
                    array_push($this->purchaseList, $purchase);
                }
            }
            catch(PDOException $pdoE){
                throw $pdoE;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally {
                return $this->purchaseList;
            }
        }

    }
?>

