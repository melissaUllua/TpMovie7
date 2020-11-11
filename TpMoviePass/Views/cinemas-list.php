<?php
    require_once('nav.php');
    //require "Config/Autoload.php";

    use Models\Cinema as Cinema; 
    use Models\Room as Room;

?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <?php  if(isset($message))
               {
                    ?> <p class= "message-small"> <?php echo $message; ?> </p>
                    <?php   
               }  
               ?>
               <h2 class="mb-4 message">Cinemas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                        <!-- <th>ID</th> -->
                         <th>Name</th>
                         <th>Address</th>
                         <th>Availability</th>
                         
                    </thead>
                    <tbody>
                    <?php 
                          foreach($cinemaList as $cinema)
                          {
                           ?>
                              <tr>
                                   <!-- <td><?php echo $cinema->getCinemaId() ?></td> -->
                                   <td><?php echo $cinema->getCinemaName() ?></td>
                                   <td><?php echo $cinema->getCinemaAddress() ?></td>
                                   <td><?php if(($cinema->getCinemaAvailability() == "1"))
                                   {
                                       echo "Available"; if ($cinema->getCinemaAmountOfRooms()>0){?>
                                       
                                        <form action="<?php echo FRONT_ROOT."Room/ShowListView/"?>" method="POST">
                                       
                                        <input type="hidden" name = "cinemaID", value= "<?php echo $cinema->getCinemaId() ?>">
                                        <button type="submit" name="button" class="btn btn-dark ml-auto d-block">See available Rooms</button>
                                       <!-- <button onclick="window.location.href='<?php echo FRONT_ROOT.'Room/ShowAddView/'?>"class="btn btn-dark">Add room</button> -->
                                        </form>
                                 <?php  }}
                                   else
                                   {
                                        echo "Unavailable";
                                   }
                                       ?>   
                                        </td>
                              </tr> 
                                   <?php
                              }
                         ?>

                    </tbody>
               </table> 
          </div>
     </section>
</main>