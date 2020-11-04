<?php ///falta modificar
    require_once('nav.php');
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
               <form action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row"> 
                    <!--<div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">ID</label>
                                   <input type="text" name="cinemaID" value="" class="form-control">
                              </div>-->
                         </div>                        
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Name</label>
                                   <input type="text" name="cinemaName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Address</label>
                                   <input type="text" name="cinemaAddress" value="" class="form-control">
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
                         </div>-->
                         <div class="col-lg-4">
                              <label for="">Type</label>
                                   <select name="cinemaAvailability" id="" class="form-control">
                                   <option value="1">Available</option>
                                   <option value="0">Unavailable</option>
                                   </select>
                              </div>
                         <!--<div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Amount of rooms</label>
                                   <input type="number" name="cinemaTotalRooms" value="" class="form-control" min = 1>
                              </div>
                         </div> -->
                         <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add</button>
                    </div>
                   
               </form>
          </div>
     </section>
</main>