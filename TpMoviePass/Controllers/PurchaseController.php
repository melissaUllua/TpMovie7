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

    public function Add($ShowId, $Seats, $Owner, $CardNumber, $Cvv, $ExpMonth, $ExpYear)
        {
            $show = new Show();
            $show->setShowId($ShowId);
            //var_dump($show);
            $purchase = new Purchase();
            $purchase->setAmountOfSeats($Seats);
            $cardDAO = new CreditCardDAOBD();
            $creditCard = new CreditCard();
            if($cardDAO->ExistsCardNumber($CardNumber))
            {
                $creditCard = $cardDAO->ExistsCardNumber($CardNumber);
               // var_dump($creditCard);
            }
            else
            {
            $creditCard = new CreditCard();
            $creditCard->setCardOwner($Owner);
            $creditCard->setCardNumber($CardNumber);
            $creditCard->setCardCvv($Cvv);
            $creditCard->setCardExpirationMonth($ExpMonth);
            $creditCard->setCardExpirationYear($ExpYear);
            $creditCardDao = new CreditCardDAOBD();
            $id = $creditCardDao->Add($creditCard);
            var_dump($id);
            }
           
           
            
            //var_dump($idCreditCard);
            //// faltaria el calculo para el precio final////
            
           
            
            $purchase->setCreditCard($creditCard);
            $purchase->setShow($show);
             //var_dump($purchase);
            $this->purchaseDAO->Add($purchase);

            ///
            require_once(VIEWS_PATH."aaprueba.php");
        }













}


?>