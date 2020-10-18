<?php
   // require_once('nav.php');
    //require "Config/Autoload.php";
    

   /* use Models\Movie as Movie; 
    use DAO\MovieDAO as MovieDAO; 
    
    $movieDao = new MovieDAO();
   
    $movieList =  $movieDao->retrieveDataFromAPI();
    */
?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Precio de la entrada</th>
                         <th>Capacidad total</th>
                         <th>Direccion </th>
                         <th>Modificar</th>
                         <th>Eliminar</th>
                    </thead>
                    <tbody>
                         <?php 
                         //var_dump($movieList);
                              /*foreach($movieList as $id => $movie)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $movie->getOriginal_title() ?></td>
                                        </tr> 
                                   <?php
                              }
                              */
                         ?>
                         </tr>
                    </tbody>
               </table>
               <!--<form action="<?php //echo FRONT_ROOT ?>movie/Editmovie". method="post" class="bg-light-alpha p-5">
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