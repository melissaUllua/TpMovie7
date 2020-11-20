<?php ///falta modificar
    require_once('nav.php');
    if((isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1))){
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <?php 
               if(isset($message))
               {
                    echo $message;
               }
          ?>
               <h2 class="mb-4">Add Cinema</h2>
               <form action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha pl-5 pt-3 pb-3 pr-0">
                    <div class="row"> 
                    <!--<div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">ID</label>
                                   <input type="text" name="cinemaID" value="" class="form-control">
                              </div>
                         </div>     -->                   
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for=""><strong>Name</strong></label>
                                   <input type="text" name="cinemaName" value="" class="form-control" placeholder= "Example 'Cinema One'" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for=""><strong>Address</strong></label>
                                   <input type="text" name="cinemaAddress" value="" class="form-control"placeholder= "Example 'Cordoba 5526'" required>
                              </div>
                         </div>
                         <!--<div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Total Capacity</label>
                                   <input type="number" name="cinemaTotalCapacity" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Ticket Price</label>
                                   <input type="number" name="cinemaTicketPrice" value="" class="form-control">
                              </div> 
                         </div>
                         <div class="col-lg-4">
                              <label for="">Type</label>
                                   <select name="cinemaAvailability" id="" class="form-control">
                                   <option value="1">Available</option>
                                   <option value="0">Unavailable</option>
                                   </select>
                              </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Amount of rooms</label>
                                   <input type="number" name="cinemaTotalRooms" value="" class="form-control" min = 1>
                              </div>
                         </div> -->
                        
                              <div class="form-group">
                         <button type="submit" name="button" class="btn btn-dark ml-5 mt-4 d-block">Add</button>
                         </div>
                                        
               </form>
               </div>
          <?php   } else {  ?> <p class= "message"> You are not authorized to view this section <?php }?>
     </section>
</main>