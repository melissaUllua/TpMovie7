<?php namespace Models;

class Admin{
    private $adminName;
    private $adminPass;
    private $adminId;
    private $isActive;



    /**
     * Get the value of adminName
     */ 
    public function getAdminName()
    {
        return $this->adminName;
    }

    /**
     * Set the value of adminName
     *
     * @return  self
     */ 
    public function setAdminName($adminName)
    {
        $this->adminName = $adminName;

        return $this;
    }

    /**
     * Get the value of adminPass
     */ 
    public function getAdminPass()
    {
        return $this->adminPass;
    }

    /**
     * Set the value of adminPass
     *
     * @return  self
     */ 
    public function setAdminPass($adminPass)
    {
        $this->adminPass = $adminPass;

        return $this;
    }

    /**
     * Get the value of adminId
     */ 
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * Set the value of adminId
     *
     * @return  self
     */ 
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;

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
    }

?>