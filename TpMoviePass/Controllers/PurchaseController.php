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
    public function ShowSelectCard($IdUser)
    {
        $cardDAO = new CreditCardDAOBD();
        $cardList = $cardDAO->CardsByUser($IdUser);
        var_dump($IdUser);
        require_once('select-creditcard.php');
    }

    public function ShowBuyView($ShowId)
    {
        ///Verificacion de tickets disponibles
        $Show = new Show();
        $Show->setShowId($ShowId);
        //var_dump($showId);
        require_once(VIEWS_PATH."showBuyForm.php");
    }

    public function ShowPurchaseView($purchase)
    {
       // $this->purchaseDAO->GetPurchaseByUser($idCreditCard);
        require_once(VIEWS_PATH."purchase-list.php");
    }

    public function Add($ShowId, $Seats, $Owner, $CardNumber, $Cvv, $ExpMonth, $ExpYear)
        {
            $show = new Show();
            $show->setShowId($ShowId);
            //var_dump($show);
            $purchase = new Purchase();
            $purchase->setAmountOfSeats($Seats);
            $cardDAO = new CreditCardDAOBD();
            $creditCard = new CreditCard();
            if($cardDAO->ExistsCardNumber($CardNumber)>= 0) //me fijo si la tarjeta existe
            {
                $idCreditCard = $cardDAO->ExistsCardNumber($CardNumber); //si existe, me retorna el id de la tarjeta
            }
            else
            { //si no existe, la agrego
            $creditCard = new CreditCard();
            $creditCard->setCardOwner($Owner);
            $creditCard->setCardNumber($CardNumber);
            $creditCard->setCardCvv($Cvv);
            $creditCard->setCardExpirationMonth($ExpMonth);
            $creditCard->setCardExpirationYear($ExpYear);
            $creditCardDao = new CreditCardDAOBD();
            $creditCardDao->Add($creditCard);

            $idCreditCard = $cardDAO->ExistsCardNumber($CardNumber); //ahora me aseguro que la tarjeta está ingresada y que me retorne el Id

            }
             
            //// faltaria el calculo para el precio final////
                             
            $purchase->setCreditCard($creditCard);
            $purchase->setShow($show);
            $this->purchaseDAO->Add($purchase, $idCreditCard);

            $this->ShowPurchaseView($purchase);
        }













}


?>