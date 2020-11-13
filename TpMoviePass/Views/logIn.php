<?php 
 require_once('nav.php');

?>
     <main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
          
          
               <h2 class="mb-4 message">Log In</h2>
               <?php 
                 if(isset($message))
               {
                    ?> <p class= "message-small"> <?php echo $message; ?> </p>
                    <?php   
               }   
               ?>
               <form action="<?php echo FRONT_ROOT ?>User/LogIn" method="POST" class="bg-light-alpha p-5">
               <div class= "row">
                    <div class="col-lg-4">
                         <label for=""> User Name</label>
                         <input type="text" name="userName" class="form-control" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group">
                         <label for="">Password</label>
                         <input type="password" name="userPass" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Log In</button>
               </div>
               </form>             
          
          </div>
     </main>

<?php
     include('footer.php')
?>
