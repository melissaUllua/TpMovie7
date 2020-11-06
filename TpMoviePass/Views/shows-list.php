<?php 
require_once('nav.php');

?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Cinemas</h2>
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
                              
                                   <?php 
                                   var_dump($show);
                                   echo $show->getShowMovie()->getTitle(); ?></td> 
                                   <td><?php echo $show->getShowRoom()->getRoomCinema()->getCinemaName(); ?></td>
                                   <td><?php echo $show->getShowRoom()->getRoomName(); ?></td>
                                   <td><?php $room->getShowDate(); ?>
                                   <td><?php $room->getShowTime(); ?>
                                  
                                        ?></td>
                                        <td><form action="<?php echo FRONT_ROOT."Room/ShowListView/"?>" method="POST" class="bg-light-alpha p-5">
                                       
                                        <input type="hidden" class="btn btn-dark" name = "cinemaID", value= "<?php echo $cinema->getCinemaId() ?>">
                                        <button type="submit" name="button" class="btn btn-dark ml-auto d-block">See available Rooms</button>
                                       <!-- <button onclick="window.location.href='<?php echo FRONT_ROOT.'Room/ShowAddView/'?>"class="btn btn-dark">Add room</button> -->
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