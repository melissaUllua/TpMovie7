<?php

namespace Controllers;

use \Exception as Exception;
use \PDOException as PDOException;
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
use Models\PHPMailer as PHPMailer;
use Models\ExceptionMailer as ExceptionMailer;
use Models\SMTP as SMTP;

class PurchaseController{
    private $purchaseDAO;

    public function __construct()
    {
       // $this->roomDAO = new RoomDAO();
        $this->purchaseDAO = new PurchaseDAOBD();
    }
    public function ShowConsultsByMovies($TotalIncome = "")
    {
        $movieDAOBD = new MovieDAOBD();
        try{
            $movieList = $movieDAOBD->getAll();
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
        
            require_once(VIEWS_PATH.'consultsByMovie.php');
            }
    }
    public function ShowConsultsByCinema($TotalIncome = "")
    {
        //var_dump($totalIncome);
        $CinemaDAO = new CinemaDAOBD();
        $cinemaList = array();
        try{
        $cinemaList = $CinemaDAO->getAvailable();
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
        require_once(VIEWS_PATH.'consultsByCinema.php');
        }
    }
    public function ConsultByMovie($IdMovie, $firstDate, $lastDate)
    {
        try{
        $totalIncome = $this->purchaseDAO->TotalIncomeByDate($IdMovie, $firstDate, $lastDate);
        //var_dump($totalIncome);
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
        
            $this->ShowConsultsByMovies($totalIncome);
           // var_dump($totalIncome);
        }


    }
    public function ConsultByCinema($IdCinema, $firstDate, $lastDate)
    {
        try {
        $TotalIncome = $this->purchaseDAO->TotalIncomeByDateByCinema($IdCinema, $firstDate, $lastDate);
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
            //var_dump($TotalIncome);
        $this->ShowConsultsByCinema($TotalIncome);
        }


    }
    public function ShowBuyView($ShowId, $message ="")
    {
        ///Verificacion de tickets disponibles
        $Show = new Show();
        $Show->setShowId($ShowId);
        //var_dump($showId);
        require_once(VIEWS_PATH."showBuyForm.php");
    }
    public function ShowPurchaseByShow($IdUser)
    {
        try{
        $PurchasesList = $this->purchaseDAO->GetPurchasesByUser($IdUser);
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
        require_once(VIEWS_PATH."showPurchaseByShow.php");
        }
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
            require_once(VIEWS_PATH."purchase-list.php");
        }
    }

    public function Add($ShowId, $Seats, $Owner, $CardNumber, $Cvv, $ExpMonth, $ExpYear)
    {
        try{
            $show = new Show();
            $show->setShowId($ShowId);
            $purchase = new Purchase();
           // $purchase->setAmountOfSeats($Seats);
            $TotalSeats = $this->purchaseDAO->TotalSeatsByShow($ShowId);
            $TotalSeats = $TotalSeats + $Seats;
            $show = new Show();
            $showDao = new ShowDAOBD();

            $show = $showDao->GetOneById($ShowId); //GetOneById
          
            $room = new Room();
            $roomDao = new RoomDAOBD();
          
            $room = $roomDao->getOneRoom($show->getShowRoom()->getRoomId());
            //var_dump($TotalSeats);
            if($TotalSeats > $room->getRoomCapacity()) ///Reviso que la cantidad de asientos agregados sea < que la capacidad
            {
                ///Puede que esa no sea la frase correcta
                $message = "Sorry! There's not available that amount of seats";
                $this->ShowBuyView($ShowId, $message);
                echo "entra";
            }
            else
            {
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
           

            $finalPrice = ($room->getroomPrice() * $Seats);
            
            $purchase->setCreditCard($creditCard);
            $purchase->setShow($show);
            $purchase->setFinalPrice($finalPrice);
           
            $this->purchaseDAO->Add($purchase, $idCreditCard);
            
            $this->ShowPurchaseView($purchase);
        }

            $url = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $purchase->getIdPurchase() . '&choe=UTF-8.jpg';
            $img = FRONT_ROOT . 'QRimages/' . $purchase->getIdPurchase() . '.jpg';
            file_put_contents($img, file_get_contents($url));


            $this->sendPurchaseEmail($purchase);

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



        public function sendPurchaseEmail(Purchase $purchase){


            $mail = new PHPMailer(TRUE);
    
            /* Open the try/catch block. */
            try {
                /* Set the mail sender. */
                $mail->setFrom('tpmoviepass.lab4.utn@gmail.com', 'TpMoviePass ADMIN');
                
                /* Add a recipient. */
                $mail->addAddress($_SESSION['userEmail'], $_SESSION['userName']);
                
                /* Set the subject. */
                $mail->Subject = 'Tu compra en MoviePass';
    
                /* SMTP parameters. */
                
                /* Tells PHPMailer to use SMTP. */
                $mail->isSMTP();
                $mail->isHTML(true);
                
                /* SMTP server address. */
                $mail->Host = 'smtp.gmail.com';
    
                /* Use SMTP authentication. */
                $mail->SMTPAuth = TRUE;
                
                /* Set the encryption system. */
                $mail->SMTPSecure = 'tls';
                
                /* SMTP authentication username. */
                $mail->Username = 'tpmoviepass.lab4.utn@gmail.com';
                
                /* SMTP authentication password. */
                $mail->Password = 'melidaiagus';
                
                /* Set the SMTP port. */
                $mail->Port = 587;


                $mail->AddAttachment('QRimages/' . $purchase->getIdPurchase() . '.jpg');

    
                $showAux = new Show;
                $showAux = $purchase->getShow();
                $creditCardAux = new CreditCard;
                $creditCardAux = $purchase->getcreditCard();
    
    
                $mail->Body    = '<BODY BGCOLOR="White">
                    <body>
                    <div Style="align:center;">
                    <p> PURCHASE INFORMATION  </p>
                    <pre>
                    <p>'."Date:". $showAux->getShowDate() ." - Hour: " .$showAux->getShowTime()."</p>
                    <p>Tickets Quantity: " .$purchase->getAmountOfSeats()."</p>
                    <p>Credit Card: " . $creditCardAux->getCardNumber()."</p>
                    <p>TOTAL: $" .$purchase->getFinalPrice()."</p>".'
                    </pre>
                    <p>
                    </p>
                    </div>
                    </br>
                    <div style=" height="40" align="left">
                    <font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
                    <div class="info" Style="align:left;">           
    
                    <br>
                    <p>Please find the QR code attached to this email.   </p> 
                    <br>
                    </div>
    
                    </br>
                    <p>-----------------------------------------------------------------------------------------------------------------</p>
                    </br>
                    </font>
                    </div>
                    </body>';
    
                
                /* Finally send the mail. */
                $mail->send();
    
    
            }
            catch (ExceptionMailer $e)
            {
            /* PHPMailer exception. */
            echo $e->errorMessage();
            //$message = $e->errorMessage();
            }
            catch (\Exception $e)
            {
            /* PHP exception (note the backslash to select the global namespace Exception class). */
            echo $e->getMessage();
            //$message = $e->errorMessage();
            }
    
        }
    }
    ?>