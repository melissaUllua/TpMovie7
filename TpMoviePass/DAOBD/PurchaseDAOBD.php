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



        public function Add(Purchase $purchase, $idCreditCard)  //agrega la compra a la base de datos
        {
            //var_dump($purchase);
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
        public function TotalSeatsByShow($IdShow)
        {///Devuelve la cantidad de asientos comprados en determinado show
           
            try
            {
                $purchaseList = array();
                $totalSeats = 0;
               
                $query = 'SELECT SUM(seats) as totalSeats FROM '.$this->tableName . ' WHERE IdShow = "' . $IdShow . '";';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {                
                
                  $row = $resultSet['0'];
                  
                  if ($row["totalSeats"] == null)
                  {
                      $totalSeats = 0;
                     // var_dump($row["totalSeats"]);   
                      
                  }
                  else
                  {
                  $totalSeats = $row["totalSeats"];
                 
                  }
                  
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                return $totalSeats; 
            }
        }
        public function TotalSeatsByMovie($IdMovie)
        {///funciona, hay que agregarla a las vistas
           
            try
            {
                $purchaseList = array();
                $totalSeats = 0;
               
                ///funciona bien, necesito ver como pasarlo a una sola variable
                $query = 'SELECT SUM(seats) as totalSeats FROM '.$this->tableName .  ' as p 
                INNER JOIN Shows s on p.IdShow = s.IdShow 
                INNER JOIN Movies m on m.IdMovie = s.IdMovie
                WHERE m.IdMovie = " ' . $IdMovie . '" ;';
                //var_dump($query);
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {                
                
                  $row = $resultSet['0'];
                  
                  
                  if ($row["totalSeats"] == null)
                  {
                      $totalSeats = 0;
                     // var_dump($row["totalSeats"]);   
                      
                  }
                  else
                  {
                  $totalSeats = $row["totalSeats"];
                 
                  }
                  
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                return $totalSeats; 
            }
        }
        public function TotalSeatsByCinema($IdCinema)
        {///funciona, hay que agregarla a las vistas
           
            try
            {
                $purchaseList = array();
                $totalSeats = 0;
               
                ///funciona bien, necesito ver como pasarlo a una sola variable
                $query = 'SELECT SUM(seats) as totalSeats FROM '.$this->tableName .  ' as p 
                INNER JOIN Shows s on p.IdShow = s.IdShow 
                INNER JOIN Rooms r on r.IdRoom = s.IdRoom
                WHERE r.IdCinema = " ' . $IdCinema . '" ;';
               // var_dump($query);
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {                
                
                  $row = $resultSet['0'];
                  
                  if ($row["totalSeats"] == null)
                  {
                      $totalSeats = 0;
                    
                  }
                  else
                  {
                  $totalSeats = $row["totalSeats"];
                 
                  }
                  
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                return $totalSeats; 
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
                $query = 'SELECT * FROM '.$this->tableName .
                'WHERE IdShow in (SELECT IdShow FROM Shows WHERE IdMovie = "' .$IdMovie .'");'; 
                
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
                var_dump($purchaseList);
                return $this->purchaseList;
            }
        }
        public function GetPurchasesTotalIncomeByMovie($IdMovie)
        {///funciona, hay que agregarla a las vistas
           
            try
            {
                $purchaseList = array();
                $totalIncome = 0;
               /// pensé en hacer esta query con una subquery, pero todavía es medio dudoso
                $query = 'SELECT FinalPrice FROM '.$this->tableName .
                ' WHERE IdShow in (SELECT IdShow FROM Shows WHERE IdMovie = "' .$IdMovie .'");'; 
                
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
              
                foreach ($resultSet as $row) {
                   // var_dump($resultSet);
                  $totalIncome = $totalIncome + $row["FinalPrice"];
                    
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
                //var_dump($totalIncome);
                return $totalIncome;
            }
        }
       
        public function TotalIncomeByCinema($IdCinema)
        {///funciona, hay que agregarla a las vistas
           
            try
            {
                $purchaseList = array();
                $totalIncome = 0;
               
                ///funciona bien, necesito ver como pasarlo a una sola variable
                $query = 'SELECT SUM(FinalPrice) as totalIncome FROM '.$this->tableName .  ' as p 
                INNER JOIN Shows s on p.IdShow = s.IdShow 
                INNER JOIN Rooms r on r.IdRoom = s.IdRoom
                WHERE r.IdCinema = " ' . $IdCinema . '" ;';
               // var_dump($query);
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {                
                
                  $row = $resultSet['0'];
                  
                  if ($row["totalIncome"] == null)
                  {
                      $totalIncome = 0;
                    
                  }
                  else
                  {
                  $totalIncome = $row["totalIncome"];
                 
                  }
                  
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                return $totalSeats; 
            }
        }
        public function TotalIncomeByDate($idMovie, $fisrtDate, $lastDate)
        {
            try
            {
                $purchaseList = array();
                $TotalIncome = 0 ;
                $query = 'SELECT sum(finalPrice) as TotalIncome FROM ' . $this->tableName .' p
                INNER JOIN shows s on p.idShow = s.Idshow
                INNER JOIN movies m on s.idMovie = " '  . $idMovie . ' "
                where s.ShowDate BETWEEN " ' .$fisrtDate. ' " AND "' .$lastDate. ' ";';
                var_dump($query);
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {                
                
                  $row = $resultSet['0'];
                  
                  if ($row["TotalIncome"] == null)
                  {
                      $TotalIncome = 0;
                    
                  }
                  else
                  {
                  $TotalIncome = $row["TotalIncome"];
                 
                  }
                  
                }
            
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                return $TotalIncome; 
            }
        }
       
        public function TotalIncomeByDateByCinema($idCinema, $firstDate, $lastDate)
        {
            try
            {
                $purchaseList = array();
                $TotalIncome = 0 ;
                $query = 'SELECT SUM(FinalPrice) as TotalIncome FROM '.$this->tableName .  ' as p 
                INNER JOIN Shows s on p.IdShow = s.IdShow 
                INNER JOIN Rooms r on r.IdRoom = s.IdRoom
                WHERE r.IdCinema = " ' . $idCinema . '" 
                AND s.ShowDate BETWEEN " ' .$firstDate. ' " AND "' .$lastDate. ' ";';
                var_dump($query);
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {                
                
                  $row = $resultSet['0'];
                  
                  if ($row["TotalIncome"] == null)
                  {
                      var_dump($totalIncome);
                      $TotalIncome = 0;
                    
                  }
                  else
                  {
                  $TotalIncome = $row["TotalIncome"];
                 
                  }
                  
                }
            
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                return $TotalIncome; 
            }
        }
       
      
    }
?>

