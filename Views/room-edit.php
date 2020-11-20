<?php require_once('nav.php'); 
use Models\Room as Room;

    use DAOBD\RoomDAOBD as RoomDAOBD;

    if((isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1))){
?>

<main class="py-5">
    
     <section id="listado" class="mb-5">
        <div class="container">    
          <h2 class="mb-4 message">Edit Room</h2>
         <?php 
           if(isset($message))
            {
                ?> <p class= "message-small"> <?php echo $message; ?> </p>
          <?php  }  
          
         //   foreach ($roomList as $room){  ?>
            
            
          <table class="table bg-light-alpha"> 
          <form action="<?php echo FRONT_ROOT . "Room/Edit/".$room->getroomId(); ?>" method="POST" class="p-5" >
          <th class= "message"><?php echo $room->getroomName(); ?></th>
              <tr>
                 
                     <td class= "row ml-auto mr-auto">
                        <input type="hidden" name="id" value="<?php echo $room->getroomId(); ?>">
                        <div class="col-lg-4">
                              <div class="form-group">
                        <label for=""> <strong>Current Name </strong></label>
                        <input class="form-control mb-3" type="text" value="<?php echo $room->getRoomName(); ?>" name="roomName" placeholder = "Name">
                        </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                        <label for=""><strong> Current Capacity </strong></label>
                        <input class="form-control mb-3" type="text" value="<?php echo $room->getRoomCapacity(); ?>" name= "roomCapacity"  placeholder= "Capacity" class="mt-3">
                        </div>
                         </div>
                       <!-- <input type="hidden" name="id" value="<?php echo $room->getroomId(); ?>"> -->
                       <div class="col-lg-4">
                              <div class="form-group">
                        <label for=""> <strong>Current Ticket Price </strong></label>
                        <input class="form-control mb-3" type="text" value="<?php echo $room->getroomPrice(); ?>" name="roomPrice" placeholder = "Ticket Price">
                        </div>
                        </div>
                        <br>
                        <div class="col-lg-4">
                              <div class="form-group">
                        <label for=""><strong>Current Type </strong></label> <br>
                        <input type="hidden" value="<?= $room->getIs3D();?>"></option>
                        <input type="radio" id="3d" value="1" name="is3D" <?php if ($room->getIs3D() == true) echo "checked" ?>>
                        <label for="3d" >3D</label>
                        <input type="radio" id="2d" value="0" name="is3D" <?php if ($room->getIs3D() == false) echo "checked" ?>>
                        <label for="2d">2D</label>
                        </div>
                        </div>
                        <br>
                        <div class="col-lg-4">
                              <div class="form-group">
                        <label for=""><strong>Current Availability </strong></label> <br>
                        <input type="hidden" value="<?= $room->getroomAvailability();?>"></option>
                        <input type="radio" id="Available" value="1" name="roomAvailability" <?php if ($room->getRoomAvailability() == true) echo "checked" ?>>
                        <label for="Available" >Available</label>
                        <input type="radio" id="Unavailable" value="0" name="roomAvailability" <?php if ($room->getRoomAvailability() == false) echo "checked" ?>>
                        <label for="Unavailable">Unavailable</label>
                        </div>
                        </div>
                        <br>
                        <input type="hidden" name="idCinema" value="<?php echo $room->getRoomCinema()->getCinemaId(); ?>">
                        <input type="submit" class="btn btn-dark mb-3" value="Save Changes" >

                        </form>     
                      </td>
              </tr>
          </table>
          
         
        </div>

  

      <?php } else {  ?> <p class= "message flex-item bg-light-alpha"> You are not authorized to view this section <?php }?>
      
     </section>
</main>