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
            try{
                $creditCard->setCardOwner($Owner);
                $creditCard->setCardNumber($CardNumber);
                $creditCard->setCardCvv($Cvv);
                $creditCard->setCardExpirationMonth($ExpMonth);
                $creditCard->setCardExpirationYear($ExpYear);
            
                $this->CreditCardDAO->Add($creditCard);
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
            finally{
               // require_once(VIEWS_PATH."aaprueba.php");
            }

        }













}


?>