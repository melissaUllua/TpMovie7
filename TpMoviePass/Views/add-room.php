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
               <h2 class="mb-4">Add rooms</h2>
               <?php
               var_dump($totalRooms);
               for($i=0 ; $i < $totalRooms ; $i++){ ?>
               <form action="<?php echo FRONT_ROOT."Room/Add" ?>" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="roomName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Capacity</label>
                                   <input type="number" name="roomCapacity" value="" class="form-control" min="1">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Type</label>
                                   <select name="roomIs3d" id="" class="form-control">
                                   <option value="true">3D</option>
                                   <option value="false">2D</option>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Price</label>
                                   <input type="number" name="roomPrice" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for=""></label>
                                   <input type="hidden" name="cinema" value="<?php $cinema->getCinemaId; ?>" class="form-control">
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add</button>
               <?php } ?>
               </form>
          </div>
     </section>
</main>