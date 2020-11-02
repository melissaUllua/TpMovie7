<?php namespace Models;

class User{
    private $userName;
    private $userPass;
    private $userId;
    private $isActive;
    private $userEmail;
    private $isAdmin;
    private $userFirstName;
    private $userLastName;



    /**
     * Get the value of userName
     */ 
    public function getuserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setuserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of userPass
     */ 
    public function getuserPass()
    {
        return $this->userPass;
    }

    /**
     * Set the value of userPass
     *
     * @return  self
     */ 
    public function setuserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getuserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setuserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of isActive
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */ 
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get the value of userEmail
     */ 
    public function getuserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set the value of userEmail
     *
     * @return  self
     */ 
    public function setuserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */ 
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */ 
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get the value of userFirstName
     */ 
    public function getuserFirstName()
    {
        return $this->userFirstName;
    }

    /**
     * Set the value of userFirstName
     *
     * @return  self
     */ 
    public function setuserFirstName($userFirstName)
    {
        $this->userFirstName = $userFirstName;

        return $this;
    }

    /**
     * Get the value of userLastName
     */ 
    public function getuserLastName()
    {
        return $this->userLastName;
    }

    /**
     * Set the value of userLastName
     *
     * @return  self
     */ 
    public function setuserLastName($userLastName)
    {
        $this->userLastName = $userLastName;

        return $this;
    }
    }

?>