<?php

namespace Controllers;

use Models\Show as Show;
use DAO\ShowDAO as ShowDAO;
use DAOBD\ShowDAOBD as ShowDAOBD;
use DAOBD\MovieDAOBD as MovieDAOBD;
use DAOBD\CinemaDAOBD as CinemaDAOBD;
use DAOBD\CreditCardDAOBD as CreditCardDAOBD;
use DAOBD\PurchaseDAOBD as PurchaseDAOBD;
use Models\Room as Room;
use Models\Movie as Movie;
use Models\CreditCard as CreditCard;
use Models\Purchase as Purchase;

class PurchaseController{
    private $purchaseDAO;

    public function __construct()
    {
       // $this->roomDAO = new RoomDAO();
        $this->purchaseDAO = new PurchaseDAOBD();
    }

    public function ShowBuyView($ShowId)
    {
        ///Verificacion de tickets disponibles
        $Show = new Show();
        $Show->setShowId($ShowId);
        var_dump($showId);
        require_once(VIEWS_PATH."showBuyForm.php");
    }

    public function Add(/*$idShow*/ $Owner, $CardNumber, $Cvv, $ExpMonth, $ExpYear, $amountOfSeats)
        {
            $creditCard = new CreditCard();
            $creditCard->setCardOwner($Owner);
            $creditCard->setCardNumber($CardNumber);
            $creditCard->setCardCvv($Cvv);
            $creditCard->setCardExpirationMonth($ExpMonth);
            $creditCard->setCardExpirationYear($ExpYear);
            $cardDAO = new CreditCardDAOBD();
            $cardDAO->add($creditCard);
            $purchase = new Purchase();
            $purchase->setAmountOfSeats($amountOfSeats);
            $purchase->setCreditCard($creditCard);

            ///
            require_once(VIEWS_PATH."aaprueba.php");
        }













}


?>