<?php 
namespace Models;

class CreditCard
{
    private $IdCreditCard;
    private $CardOwner;
    private $CardNumber;
    private $CardCvv;
    private $CardExpirationMonth;
    private $CardExpirationYear;
    private $User;

    public function __construct()
    {

    }

    public function getIdCreditCard()
    {
        return $this->IdCreditCard;
    }

  
    public function setIdCreditCard($IdCreditCard)
    {
        $this->IdCreditCard = $IdCreditCard;

    } 
    public function getCardOwner()
    {
        return $this->CardOwner;
    }

  
    public function setCardOwner($CardOwner)
    {
        $this->CardOwner = $CardOwner;

    }
    public function getCardNumber()
    {
        return $this->CardNumber;
    }

  
    public function setCardNumber($CardNumber)
    {
        $this->CardNumber = $CardNumber;

    }
    public function getCardCvv()
    {
        return $this->CardCvv;
    }

  
    public function setCardCvv($CardCvv)
    {
        $this->CardCvv = $CardCvv;

    }
    public function getCardExpirationMonth()
    {
        return $this->CardExpirationMonth;
    }

  
    public function setCardExpirationMonth($CardExpirationMonth)
    {
        $this->CardExpirationMonth = $CardExpirationMonth;

    }
    public function getCardExpirationYear()
    {
        return $this->CardExpirationYear;
    }

  
    public function setCardExpirationYear($CardExpirationYear)
    {
        $this->CardExpirationYear = $CardExpirationYear;

    }
    public function setUser($User)
    {
        $this->User = $User;

    } 
    public function getUser()
    {
        return $this->User;
    }


}

?>