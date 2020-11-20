<?php 
 require_once('nav.php');
use Models\Purchase as Purchase;

if((isset( $_SESSION['userId'] )))
?><main class="py-5">
<h1></h1>
<section id="listado" class="mb-5">
     <div class="container">
          <h2 class="mb-4 message">Rooms in this cinema</h2>
          <?php 
           if(isset($message))
            {
                ?> <p class= "message-small"> <?php echo $message; }?> </p>
          <table class="table bg-light-alpha">
               <thead>
                   <!-- <th>ID</th> -->
                    <th>Movie</th>
                    <th>Cinema</th>
                    <th>Room</th>
                    <th>Amount of tickets</th>
                    <th>Total</th>
                    
               </thead>
               <tbody>
               <?php 
                    
echo "entro?";
                          
                    ?>
                    </tr>
               </tbody>
          </table> 
     </div>
</section>
</main>