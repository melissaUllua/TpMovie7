<?php 
require_once('nav.php');
use Models\Movie as Movie;
use Models\Cinema as Cinema;


?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4 message">Shows available</h2>
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
                         <th>Buy Tickets</th>


                         
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
                                   <td><?php echo $show->getShowDate(); ?>
                                   <td><?php echo $show->getShowTime(); ?>
                                  
                                        </td>
                                        <td><form action="<?php echo FRONT_ROOT."Purchase/ShowBuyView/"?>" method="POST" class="bg-light-alpha p-5">
                                       
                                        <input type="hidden" class="btn btn-dark" name = "ShowId", value= "<?php echo $show->getShowId() ?>">
                                        <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Select show</button>
                                       <!-- <button onclick="window.location.href='<?php echo FRONT_ROOT.'Purchase/ShowBuyView/'?>"class="btn btn-dark">Add room</button> -->
                                        </form>
                                            
                                             
                                        </td>
                                            
                                        </tr> 
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table> 
          </div>
     </section>
</main>