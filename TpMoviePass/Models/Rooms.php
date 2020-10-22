<?php 
namespace Models;

class Rooms{
    private $id;
    private $name;
    private $capacity;
    private $is3D;
    private $price;

    public function __construct()
    {

    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }
    public function setin3D($is3D)
    {
        $this->is3D = $is3D;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getCapacity()
    {
        return $this->capacity;
    }
    public function getIs3d()
    {
        return $this->is3D;
    }
    public function getPrice()
    {
        return $this->price;
    }


}