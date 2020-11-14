<?php

namespace Controllers;

use \Exception as Exception;
use \PDOException as PDOException;
use \MailController as MailController;
use Models\Show as Show;
use DAO\ShowDAO as ShowDAO;
use DAOBD\ShowDAOBD as ShowDAOBD;
use DAOBD\MovieDAOBD as MovieDAOBD;
use DAOBD\CinemaDAOBD as CinemaDAOBD;
use DAOBD\RoomDAOBD as RoomDAOBD;
use DAOBD\CreditCardDAOBD as CreditCardDAOBD;
use DAOBD\PurchaseDAOBD as PurchaseDAOBD;
use Models\Room as Room;
use Models\Cinema as Cinema;
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

    public function ShowBuyView($ShowId, $message="")
    {
        ///Verificacion de tickets disponibles
        $Show = new Show();
        $Show->setShowId($ShowId);
        //var_dump($showId);
        require_once(VIEWS_PATH."showBuyForm.php");
    }

    public function ShowPurchaseView($purchase)
    {
       $show = new Show();
       $show = $purchase->getShow();
       try{
        $movie = new Movie();
        $movieAux = new Movie();
        $movieAux = $show->getShowMovie();
        $movieDao = new MovieDAOBD();
        $movie = $movieDao->searchById($movieAux->getId());
 
        $room = new Room();
        $roomDAO = new RoomDAOBD();
        $room = $roomDAO->getOneRoom($show->getShowRoom()->getRoomId());
         
        $cinema = new Cinema();
        $cinemaDao = new CinemaDAOBD();
        $cinema = $cinemaDao->getOneCinema($room->getRoomCinema()->getCinemaId());
       }
       catch(PDOException $pdoE){
        if($pdoE->getCode() == 1045){
            $message = "Wrong DB Password";
        } else{
            $message = $pdoE->getMessage();
        }
        
         }
        catch(Exception $e){
            $message = $e->getMessage();
        }
        finally
        {    
            require_once(VIEWS_PATH."purchaseList.php");
        }
    }

    public function Add($ShowId, $Seats, $Owner, $CardNumber, $Cvv, $ExpMonth, $ExpYear)
    {
        try{
            $show = new Show();
            $show->setShowId($ShowId);
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
            $room = new Room();
            $roomDao = new RoomDAOBD();
            $show = new Show();
            $showDao = new ShowDAOBD();

            $show = $showDao->GetOneById($ShowId); //GetOneById
          
            $room = $roomDao->getOneRoom($show->getShowRoom()->getRoomId());

            $finalPrice = ($room->getroomPrice() * $Seats);
            $purchase->setCreditCard($creditCard);
            $purchase->setShow($show);
            $purchase->setFinalPrice($finalPrice);
            $this->purchaseDAO->Add($purchase, $idCreditCard);

            $this->ShowPurchaseView($purchase);

            //$emailcontroller = new MailController();
            //$emailcontroller->sendEmailFalopa();

        }
        catch(PDOException $pdoE){
            if($pdoE->getCode() == 1045){
                $message = "Wrong DB Password";
            } else{
                $message = $pdoE->getMessage();
            }
            $this->ShowBuyView($ShowId, $message);
        }
        catch(Exception $e){
            $message = $e->getMessage();
            $this->ShowBuyView($ShowId, $message);
        }
            
        }

}


?>