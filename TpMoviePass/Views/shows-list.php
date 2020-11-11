<?php 
require_once('nav.php');
use Models\Movie as Movie;
use Models\Cinema as Cinema;


?>
<main class="py-5 text-white">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb- message">Shows</h2>
               <?php  if(isset($message))
               {
                    ?> <p class= "message-small"> <?php echo $message; ?> </p>
                    <?php   
               }   
               ?>
               <table class="table bg-light-alpha">
                    <thead>
                        <!-- <th>ID</th> -->
                         <th>Movie</th>
                         <th>Cinema</th>
                         <th>Room</th>
                         <th>Show date</th>
                         <th>Show time</th>
                         
                    </thead>
                    <tbody>
                    <?php 
                          foreach($showList as $show)
                          {
                           ?>
                              <tr>
                              
                              <td> <?php 
                                   $movie = new Movie();
                                   $movie = $show->getShowMovie();
                                    $cinema =  $show->getShowRoom()->getRoomCinema();

                                   echo $movie->getTitle(); ?></td> 
                                   <td><?php echo $cinema->getCinemaName(); ?></td>
                                   <td><?php echo $show->getShowRoom()->getRoomName(); ?></td>
                                   <td><?php echo $show->getShowDate(); ?></td>
                                   <td><?php echo $show->getShowTime(); ?></td>
                              </td> 
                                   <?php
                              }
                         ?>
                    </tbody>
               </table> 
          </div>
     </section>
</main>