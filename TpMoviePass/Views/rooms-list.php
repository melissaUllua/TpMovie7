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
                    <th>Quality</th>
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
                                   <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add movie show </button>
                                  </form>
                           <?php   }
                              else
                              {
                                   echo "Unavailable";
                              }
                                   ?></td>
                                   
                                   <td>
                                   </td> 
                              <?php
                         }
                    ?>
                    </tr>
               </tbody>
          </table> 
     </div>
</section>
</main>