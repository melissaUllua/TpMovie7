<?php 
include('header.php');

?>
     <main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
               <h2 class="mb-4">Inicio de Sesión</h2>
               <form action="<?php echo FRONT_ROOT ?> Admin/LogIn " method="POST" class="bg-light-alpha p-5">
               <div class= "row">
                    <div class="col-lg-4">
                         <label for="">Email</label>
                         <input type="text" name="email" class="form-control" placeholder="Ingresar usuario" required>
                    </div>
                    <div class="form-group">
                         <label for="">Contraseña</label>
                         <input type="password" name="password" class="form-control" placeholder="Ingresar constraseña" required>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Iniciar Sesión</button>
               </div>
               </form>
          </div>
     </main>

<?php
     include('footer.php')
?>
