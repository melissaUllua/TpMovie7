<?php 
 require_once('nav.php');
use Models\Purchase as Purchase;
?><main class="py-5">
<h1></h1>
<section id="listado" class="mb-5">
     <div class="container">
          <h2 class="mb-4 message">Rooms in this cinema</h2>
          <?php 
           if(isset($message))
            {
                ?> <p class= "message-small"> <?php echo $message; }?> </p>
          <table class="table bg-light-alpha">
               <thead>
                   <!-- <th>ID</th> -->
                    <th>Movie</th>
                    <th>Cinema</th>
                    <th>Room</th>
                    <th>Amount of tickets</th>
                    <th>Total</th>
                    
               </thead>
               <tbody>
               <?php 
                     foreach($roomList as $room)
                     {
                      ?>
                         <tr>
                              <td><?php echo $room->getRoomName() ?></td> 
                              <td><?php echo $room->getRoomCapacity() ?></td>
                              <td><?php if($room->getIs3d() == "1")
                              {
                                  echo "3D";
                              }
                              else
                              {
                                   echo "2D";
                              } ?>
                              <td><?php echo $room->getroomPrice() ?></td>
                              <td><?php if($room->getRoomAvailability() == "1")
                              {
                                  echo "Available"; ?>
                                  <form action="<?php echo FRONT_ROOT."Show/ShowAddView/"?>" method="POST">
                                   <input type="hidden" name = "roomID", value= "<?php echo $room->getRoomId() ?>">
                                   <button type="submit" name="button" class="btn btn-dark ml-auto mb-3 d-block">Add movie show </button>
                                  </form>
                                   <form action="<?php echo FRONT_ROOT."Room/ShowEditView/".$room->getroomId();?>" method="get" class="mb-5">
                                     <input type="hidden" value="<?php echo $room->getroomId();?>" name="Idroom">
                                     <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Edit Room</button>
                                   </form> 
                           <?php   }
                              else
                              {
                                   echo "Unavailable";
                              }
                                   ?></td>

                              <?php
                         } 
                    ?>
                    </tr>
               </tbody>
          </table> 
     </div>
</section>
</main>