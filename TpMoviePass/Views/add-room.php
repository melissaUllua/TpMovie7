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
               //foreach () cantRoom as room (?) y hacer un form p cada room                                                                                                                                                                                                                                                                                                                                                                                                                                
          ?>
               <h2 class="mb-4">Agregar cine</h2>
               <form action="<?php echo FRONT_ROOT."Room/Add" ?>" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="cinemaName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Capacidad</label>
                                   <input type="text" name="cinemaAdress" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tipo</label>
                                   <input type="num" name="cinemaTotalCapacity" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Precio</label>
                                   <input type="num" name="cinemaTicketPrice" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>