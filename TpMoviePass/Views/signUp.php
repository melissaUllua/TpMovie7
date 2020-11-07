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
               <h2 class="mb-4">Complete the form</h2>
               <form action="<?php echo FRONT_ROOT ?>User/signUp" method="post" class="bg-light-alpha p-5" required>
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">UserName</label>
                                   <input type="text" name="userName" value="" class="form-control"  placeholder= "This is how you'll be adressed in this web" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">First Name</label>
                                   <input type="text" name="userFirstName" value="" class="form-control" placeholder= "As appears in your ID card" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Last Name</label>
                                   <input type="text" name="userLastName" value="" class="form-control"placeholder= "As appears in your ID card" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="text" name="userEmail" value="" class="form-control" placeholder= "example@mail.com"  required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Password</label>
                                   <input type="password" name="userPass" value="" class="form-control" placeholder= "Between 8 and 10 characters" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Confirm Password</label>
                                   <input type="password" name="userPassCheck" value="" class="form-control" placeholder= "Enter your password again" required>
                              </div>
                         </div>
                         
               
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Sign up</button>
               </form>
          </div>
     </section>
</main>

