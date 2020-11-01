<?php 
namespace Models;

class Room{
    private $roomId;
    private $roomName;
    private $roomCapacity;
    private $is3D;
    private $roomPrice;
    private $cinemaID;

    public function __construct()
    {

    }




    /**
     * Get the value of roomId
     */ 
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set the value of roomId
     *
     * @return  self
     */ 
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get the value of roomName
     */ 
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * Set the value of roomName
     *
     * @return  self
     */ 
    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;

        return $this;
    }

    /**
     * Get the value of roomCapacity
     */ 
    public function getRoomCapacity()
    {
        return $this->roomCapacity;
    }

    /**
     * Set the value of roomCapacity
     *
     * @return  self
     */ 
    public function setRoomCapacity($roomCapacity)
    {
        $this->roomCapacity = $roomCapacity;

        return $this;
    }

    /**
     * Get the value of is3D
     */ 
    public function getIs3D()
    {
        return $this->is3D;
    }

    /**
     * Set the value of is3D
     *
     * @return  self
     */ 
    public function setIs3D($is3D)
    {
        $this->is3D = $is3D;

        return $this;
    }

    /**
     * Get the value of roomTicketPrice
     */ 
    public function getroomPrice()
    {
        return $this->roomTicketPrice;
    }
    public function setRoomCinemaID($cinemaID)
    {
        $this->cinemaID = $cinemaID;
    }
   public function getRoomCinemaID()
    {
        return $this->cinemaID;
    }

    /**
     * Set the value of roomTicketPrice
     *
     * @return  self
     */ 
    public function setroomPrice($roomTicketPrice)
    {
        $this->roomTicketPrice = $roomTicketPrice;

        return $this;
    }
}