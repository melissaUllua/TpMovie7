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
               <h2 class="mb-4">Ingrese sus datos</h2>
               <form action="<?php echo FRONT_ROOT ?>User/signUp" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="userName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="text" name="userEmail" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Ingrese Contraseña</label>
                                   <input type="password" name="userPass" value="" class="form-control">
                              </div>
                         </div>
               
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Registrar</button>
               </form>
          </div>
     </section>
</main>

