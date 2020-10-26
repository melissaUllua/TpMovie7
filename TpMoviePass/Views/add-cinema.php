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
               <h2 class="mb-4">Agregar cine</h2>
               <form action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row"> 
                    <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">ID</label>
                                   <input type="text" name="cinemaID" value="" class="form-control">
                              </div>
                         </div>                        
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="cinemaName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Dirección</label>
                                   <input type="text" name="cinemaAdress" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Capacidad total</label>
                                   <input type="number" name="cinemaTotalCapacity" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Precio de la entrada</label>
                                   <input type="number" name="cinemaTicketPrice" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <label for="">Tipo</label>
                                   <select name="cinemaAvailability" id="" class="form-control">
                                   <option value="true">Disponible</option>
                                   <option value="false">No disponible</option>
                                   </select>
                              </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Cantidad de salas</label>
                                   <input type="number" name="cinemaTotalRooms" value="" class="form-control" min = 1>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>