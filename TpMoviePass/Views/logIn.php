<?php 
include('header.php');

?>
     <main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
               <header class="text-center">
                    <h2>Inicia sesion</h2>
               </header>

               <form action="<?php echo FRONT_ROOT ?> user/login " method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                    <div class="form-group">
                         <label for="">Email</label>
                         <input type="text" name="email" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
                    </div>
                    <div class="form-group">
                         <label for="">Contraseña</label>
                         <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button>
               </form>
          </div>
     </main>

<?php
     include('footer.php')
?>
