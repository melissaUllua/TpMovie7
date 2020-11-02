<?php
    namespace DAOBD;

    use \Exception as Exception;
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
            catch(Exception $exAdd)
            {
                throw $exAdd;
            }
        }

        public function GetAll()
        {
            try
            {
                $userList = array();

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

                return $userList;
            }
            catch(Exception $exGetAll)
            {
                throw $exGetAll;
            }
        }

        public function GetUser($user)
        {
            try
            {
                $userList = array();

                $query = 'SELECT * FROM Users WHERE Users.UserName ='. $user.getuserName();

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                return $resultSet;
            }
            catch(Exception $exGetUser)
            {
                throw $exGetUser;
            }
        }

        public function GetUser2($user)
        {
            $user_found = new User();
            try
            {
                
                $users = $this->getAll();
                foreach ($users as $user_aux){
                    if ($user_aux->getuserName() == $user->getuserName()){
                        $user_found = $user_aux;
                    }

                }
            }
            catch(Exception $exGetUser2)
            {
                throw $exGetUser2;
            }
            return $user_found;
        }

        
    }
?>