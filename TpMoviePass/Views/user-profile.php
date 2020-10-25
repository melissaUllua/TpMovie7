<?php
    require_once('nav.php');
    //require "Config/Autoload.php";

    use Models\User as User; 

?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Welcome, <?php echo $_SESSION['userName']; ?></h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Email</th>

                    </thead>
                    <tbody>
                        
                       <tr>
                            <td><?php echo $_SESSION['userEmail']; ?></td>

                       </tr> 
                             
                         </tr>
                    </tbody>
               </table>
               <!--<form action="<?php //echo FRONT_ROOT ?>Cinema/EditCinema". method="post" class="bg-light-alpha p-5">
               <table class="table text-white bg-oscuro"> 
            
              <tr>
                <th>Si desea editar algun cine ingrese su nombre: </th>
                 <td>
                  <input type="text" value="modificar" size="30">
                  <button type="submit" name="button" class="">Modificar</button>
                </td>
           
             </tr>
             <tr> -->
               </form>
          </div>
     </section>
</main>