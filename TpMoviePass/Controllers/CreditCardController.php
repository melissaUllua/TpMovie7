<?php

namespace Controllers;


use DAOBD\CreditCardDAOBD as CreditCardDAOBD;
use Models\CreditCard as CreditCard;


class CreditCardController{
    private $CreditCardDAO;
    
    public function __construct()
    {
       // $this->roomDAO = new RoomDAO();
        $this->CreditCardDAO = new CreditCardDAOBD();
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH."showBuyForm.php");
    }

public function Add($Owner, $CardNumber, $Cvv, $ExpMonth, $ExpYear)
        {
            $creditCard = new CreditCard();
            $creditCard->setCardOwner($Owner);
            $creditCard->setCardNumber($CardNumber);
            $creditCard->setCardCvv($Cvv);
            $creditCard->setCardExpirationMonth($ExpMonth);
            $creditCard->setCardExpirationYear($ExpYear);
            
            $this->CreditCardDAO->Add($creditCard);
            
            
            ///
            require_once(VIEWS_PATH."aaprueba.php");
        }













}


?>