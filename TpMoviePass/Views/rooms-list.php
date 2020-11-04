<?php 
 require_once('nav.php');
use Models\Room as Room;
?><main class="py-5">
<h1></h1>
<section id="listado" class="mb-5">
     <div class="container">
          <h2 class="mb-4">Cinemas</h2>
          <table class="table bg-light-alpha">
               <thead>
                   <!-- <th>ID</th> -->
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Is 3d</th>
                    <th>Price</th>
                    <th>Availability</th>
                    
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
                                  echo "is 3d";
                              }
                              else
                              {
                                   echo "is 2d";
                              } ?>
                              <td><?php echo $room->getroomPrice() ?></td>
                              <td><?php if($room->getRoomAvailability() == "1")
                              {
                                  echo "Available";
                              }
                              else
                              {
                                   echo "Unavailable";
                              }
                                   ?></td>
                                   
                                   <td><form action="<?php echo FRONT_ROOT."Show/ShowAddView/"?>" method="POST" class="bg-light-alpha p-5">
                                   <input type="hidden" name = "roomID", value= "<?php echo $room->getRoomId() ?>">
                                       <?php var_dump($room); ?>
                                       <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add movie show </button>
                                       </form>
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