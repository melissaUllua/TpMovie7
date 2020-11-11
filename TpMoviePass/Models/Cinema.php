<?php namespace Models;

class Cinema{

    private $cinemaId;
    private $cinemaName;
    private $cinemaTotalCapacity;
    private $cinemaTicketPrice;
    private $cinemaAddress;
    private $cinemaAvailability;
    private $cinemaTotalRooms;



    public function __construct()
    {
        //$this->rooms = array();
        $this->cinemaRooms = array();

    }

    /**
     * Get the value of cinemaId
     */ 
    public function getCinemaId()
    {
        return $this->cinemaId;
    }

    /**
     * Set the value of cinemaId
     *
     * @return  self
     */ 
    public function setCinemaId($cinemaId)
    {
        $this->cinemaId = $cinemaId;

        return $this;
    }

    /**
     * Get the value of cinemaName
     */ 
    public function getCinemaName()
    {
        return $this->cinemaName;
    }

    /**
     * Set the value of cinemaName
     *
     * @return  self
     */ 
    public function setCinemaName($cinemaName)
    {
        $this->cinemaName = $cinemaName;

        return $this;
    }

    /**
     * Get the value of cinemaTotalCapacity
     */ 
    public function getCinemaTotalCapacity()
    {
        return $this->cinemaTotalCapacity;
    }

    /**
     * Set the value of cinemaTotalCapacity
     *
     * @return  self
     */ 
    public function setCinemaTotalCapacity($cinemaTotalCapacity)
    {
        $this->cinemaTotalCapacity = $cinemaTotalCapacity;

        return $this;
    }

    /**
     * Get the value of cinemaTicketPrice
     */ 
    public function getCinemaTicketPrice()
    {
        return $this->cinemaTicketPrice;
    }

    /**
     * Set the value of cinemaTicketPrice
     *
     * @return  self
     */ 
    public function setCinemaTicketPrice($cinemaTicketPrice)
    {
        $this->cinemaTicketPrice = $cinemaTicketPrice;

        return $this;
    }

    /**
     * Get the value of cinemaAddress
     */ 
    public function getCinemaAddress()
    {
        return $this->cinemaAddress;
    }

    /**
     * Set the value of cinemaAddress
     *
     * @return  self
     */ 
    public function setCinemaAddress($cinemaAddress)
    {
        $this->cinemaAddress = $cinemaAddress;

        return $this;
    }

    /**
     * Get the value of cinemaAvailability
     */ 
    public function getCinemaAvailability()
    {
        return $this->cinemaAvailability;
    }

    /**
     * Set the value of cinemaAvailability
     *
     * @return  self
     */ 
    public function setCinemaAvailability($cinemaAvailability)
    {
        $this->cinemaAvailability = $cinemaAvailability;

        return $this;
    }

    public function getCinemaTotalRooms()
    {
        return $this->cinemaTotalRooms;
    }
    public function setCinemaTotalRooms($cinemaTotalRooms)
    {
        $this->cinemaTotalRooms = $cinemaTotalRooms;
    }

    /* Por si necesitamos sólo la cantidad
     */
    public function getCinemaAmountOfRooms() 
    {
        return count($this->cinemaTotalRooms);
    }
    
}

?>