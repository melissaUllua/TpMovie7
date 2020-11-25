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

    /**
     * @return 1 si se agregó con éxito, 0 si la tarjeta ya existía- de acuerdo al número de tarjeta
     */

public function Add($Owner, $CardNumber, $Cvv, $ExpMonth, $ExpYear)
        {
             $creditCard = new CreditCard();
            try{
                $this->CreditCardDAO->GetCardByNumber($CardNumber);
                if($creditCard == null){
                $creditCard->setCardOwner($Owner);
                $creditCard->setCardNumber($CardNumber);
                $creditCard->setCardCvv($Cvv);
                $creditCard->setCardExpirationMonth($ExpMonth);
                $creditCard->setCardExpirationYear($ExpYear);
            
                $this->CreditCardDAO->Add($creditCard);
                $flag = 1; 
                } 
                else{
                    $flag = 0;
                }
                
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
               return $flag;
            }

        }













}


?>