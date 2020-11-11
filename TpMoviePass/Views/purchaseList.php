<?php 
require_once('nav.php');
use Models\Purchase as Purchase;
use Models\Cinema as Cinema;
use Models\Room as Room;
use Models\Show as Show;
use Models\Movie as Movie;


?>
<main class="py-5 text-white">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4 message">Your Purchase</h2>
               <table class="table bg-light-alpha">
                    <thead>
                        <!-- <th>ID</th> -->
                         <th>Amount of seats</th>
                         <th>Movie</th>
                         <th>Cinema</th>
                         <th>Room</th>
                         <th>Show date</th>
                         <th>Show time</th>
                         
                    </thead>
                    <tbody>
                    <?php
                    var_dump($purchase);
                    $show = new Show();
                    $show = $purchase->getShow();
                  
                    ?>
                     <td> <?php echo $purchase->getAmountOfSeats(); ?> </td> 
                     <td> <?php echo $show->getShowMovie()->getTitle(); ?> </td> 
                     <td> <?php echo $show->getShowCinema()->getCinemaName(); ?> </td> 
                     <td> <?php echo $show->getShowRoom()->getRoomName(); ?> </td> 
                     <td> <?php echo $show->getShowTime(); ?> </td> 
                     <td> <?php echo $show->getShowDate(); ?> </td> 
                    </tbody>
               </table> 
          </div>
     </section>
</main>