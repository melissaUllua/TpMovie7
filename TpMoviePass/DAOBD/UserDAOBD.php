<?php
    namespace DAOBD;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use Models\User as User;    
    use DAOBD\Connection as Connection;

    class UserDAOBD {
        private $connection;
        private $tableName = "Users";

        public function Add(user $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (UserFirstName, UserLastName, UserName, UserPass, UserIsActive, UserEmail, UserIsAdmin) 
                VALUES (:userFirstName, :userLastName, :userName, :userPass, :userIsActive, :userEmail, :userIsAdmin);";

                $parameters['userFirstName'] = $user->getuserFirstName();
                $parameters['userLastName'] = $user->getuserLastName();
                $parameters['userName'] =  $user->getuserName();
                $parameters['userPass']= $user->getuserPass();
                $parameters['userIsActive'] = $user->getIsActive();
                $parameters['userEmail'] = $user->getuserEmail();
                $parameters['userIsAdmin'] = $user->getIsAdmin();
                


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
        }

        public function GetAll()
        {
            $userList = array();
            try
            {
                

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                                       
                    $user = new User();
                    $user->setuserId($row['IdUser']);
                    $user->setuserFirstName($row['UserFirstName']);
                    $user->setuserLastName($row['UserLastName']);
                    $user->setuserName($row['UserName']);
                    $user->setuserPass($row['UserPass']);
                    $user->setIsActive($row['UserIsActive']);
                    $user->setuserEmail($row['UserEmail']);
                    $user->setIsAdmin($row['UserIsAdmin']);

                    array_push($userList, $user);
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
                return $userList;
            }
        }

         /**
         * Trae todos los usuarios de la base de datos que coincidan en nombre
         */
        public function GetUser($user_aux)
        {
            $user = new User();
            try
            {
                
                $query = 'SELECT * FROM '. $this->tableName .' WHERE UserName ="'. $user_aux->getuserName().'";';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                if($resultSet){
                    $row = $resultSet[0];
                    $user->setuserId($row['IdUser']);
                    $user->setuserFirstName($row['UserFirstName']);
                    $user->setuserLastName($row['UserLastName']);
                    $user->setuserName($row['UserName']);
                    $user->setuserPass($row['UserPass']);
                    $user->setIsActive($row['UserIsActive']);
                    $user->setuserEmail($row['UserEmail']);
                    $user->setIsAdmin($row['UserIsAdmin']);
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
                return $user;
            }
        }
           
    }
?>