<?php

use Models\Purchase as Purchase;
use DAOBD\UserDAOBD as UserDAOBD;
use Models\PHPMailer as PHPMailer;
use Models\Exception as Exception;
use Models\SMTP as SMTP;



class MailController{

    public function sendEmailFalopa(Purchase $purchase){

        $mail = new PHPMailer(TRUE);

        /* Open the try/catch block. */
        try {
            /* Set the mail sender. */
            $mail->setFrom('tpmoviepass.lab4.utn@gmail.com', 'Agus SENDER');
            
            /* Add a recipient. */
            $mail->addAddress('agusttinv@gmail.com', 'Agus RECIPIENT');
            
            /* Set the subject. */
            $mail->Subject = 'esto es un Test';

            /* SMTP parameters. */
            
            /* Tells PHPMailer to use SMTP. */
            $mail->isSMTP();
            
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




            $mail->Body    = '<BODY BGCOLOR="White">
                <body>
                <div Style="align:center;">
                <p> PURCHASE INFORMATION  </p>
                <pre>
                <p>'."Date: AGREGAR FECHA - Hour: AGREGAR HORA </p>
                <p>TicketsAmount: AGREGAR PRECIO </p>
                <p>Credit Card: AGREGAR CON QUE TARJETA SE PAGO </p>
                <p>TOTAL: AGREGAR EL MONTO TOTAL </p>".'
                </pre>
                <p>
                </p>
                </div>
                </br>
                <div style=" height="40" align="left">
                <font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
                <div class="info" Style="align:left;">           

                <br>
                <p>AGREGAR EL ARCHIVO ADJUNTO CON EL QR   </p> 
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
        catch (Exception $e)
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


        public function sendPurchaseEmail(Purchase $purchase,$qrsToSend)
        {
            $user = $this->usersDAO->searchById($_SESSION['idUserLogged']);
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'tpmoviepass.lab4.utn@gmail.com@gmail.com';                     // SMTP username
                $mail->Password   = 'melidaiagus';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('tpmoviepass.lab4.utn@gmail.com', 'CinemApp');
                $emailToSend = $user->getEmail();
                $mail->addAddress($emailToSend, 'User');     // Add a recipient
            // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Mensaje de agradecimiento por la compra bla bla';
            
                /*
                foreach ($qrsToSend as $item) {
                    $photo=$item->getFileName();
                    $mail->AddEmbeddedImage("QR/temp/$photo","qr");

                }
                */


                
                $mail->Body    = '<BODY BGCOLOR="White">
            <body>
            <div Style="align:center;">
            <p> PURCHASE INFORMATION  </p>
            <pre>
            <p>'."Date:". $purchase->getDate() ." - Hour: " .$purchase->getHour()."</p>
            <p>TicketsAmount: " .$purchase->getTicketAmount()."</p>
            <p>Credit Card: " . $purchase->getcreditCard()->getNumber()."</p>
            <p>TOTAL: " .$purchase->getTotal()."</p>".'
            </pre>
            <p>
            </p>
            </div>
            </br>
            <div style=" height="40" align="left">
            <font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
            <div class="info" Style="align:left;">           

            <br>
            <p>Company:   CinemApp   </p> 
            <br>
            </div>

            </br>
            <p>-----------------------------------------------------------------------------------------------------------------</p>
            </br>
            <p>( This is an automated message, please do not reply to this message, if you have any queries please contact CinemAppSuppUTN@gmail.com )</p>
            </font>
            </div>
            </body>';


                $mail->send();
                
            } catch (Exceptionn $e) {
                array_push($advices, DB_ERROR . $mail->ErrorInfo);
            }
        }

    }

?>