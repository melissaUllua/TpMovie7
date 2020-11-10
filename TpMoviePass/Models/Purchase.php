<?php 
namespace Models;

class Purchase{
    private $idPurchase;
    private $Show;
    private $User;
    private $AmountOfSeats;
    private $CreditCard;
    private $FinalPrice;
   

    public function __construct()
    {

    }
    public function getIdPurchase()
    {
        return $this->idPurchase;
    }

  
    public function setIdPurchase($idPurchase)
    {
        $this->idPurchase = $idPurchase;

    }

    public function getShow()
    {
        return $this->Show;
    }

  
    public function setShow($Show)
    {
        $this->Show = $Show;

    }
    public function getUser()
    {
        return $this->User;
    }

  
    public function setUser($User)
    {
        $this->User = $User;

    }
    public function getAmountOfSeats()
    {
        return $this->AmountOfSeats;
    }

  
    public function setAmountOfSeats($AmountOfSeats)
    {
        $this->AmountOfSeats = $AmountOfSeats;

    }
    public function getCreditCard()
    {
        return $this->CreditCard;
    }

  
    public function setCreditCard($CreditCard)
    {
        $this->CreditCard = $CreditCard;

    }

    public function getFinalPrice()
    {
        return $this->FinalPrice;
    }

  
    public function setFinalPrice($FinalPrice)
    {
        $this->FinalPrice = $FinalPrice;

    }
   
}

?>