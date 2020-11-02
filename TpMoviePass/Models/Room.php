<?php 
namespace Models;

class Room{
    private $id;
    private $name;
    private $capacity;
    private $is3D;
    private $price;
    private $cinemaID;
    private $availability;

    public function __construct()
    {

    }
    public function setRoomId($id)
    {
        $this->id = $id;
    }
    public function setRoomName($name)
    {
        $this->name = $name;
    }
    public function setRoomCapacity($capacity)
    {
        $this->capacity = $capacity;
    }
    public function setRoomIs3D($is3D)
    {
        $this->is3D = $is3D;
    }
    public function setRoomPrice($price)
    {
        $this->price = $price;
    }
    public function getRoomId()
    {
        return $this->id;
    }
    public function getRoomName()
    {
        return $this->name;
    }
    public function getRoomCapacity()
    {
        return $this->capacity;
    }
    public function getRoomIs3d()
    {
        return $this->is3D;
    }
    public function getRoomPrice()
    {
        return $this->price;
    }
    public function setRoomCinemaID($cinemaID)
    {
        $this->cinemaID = $cinemaID;
    }
   public function getRoomCinemaID()
    {
        return $this->cinemaID;
    }
    public function setRoomAvailability($roomAvailability)
    {
        $this->availability = $roomAvailability;
    }
   public function getRoomAvailability()
    {
        return $this->availability;
    }


}