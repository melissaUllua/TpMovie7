<?php

    require_once('nav.php');
    //require "Config/Autoload.php";

    use Models\Movie as Movie; 
    use DAO\MovieDAO as MovieDAO; 
    
    $movieDao = new MovieDAO;
    $movieList =  $movieDao->getAll();
    
?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Movie List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Title</th>
                         <th>Release date</th>
                         <th>Language </th>
                         <th>Overview</th>
                         <th>Poster</th>
                    </thead>
                    <tbody>
                         <?php 
                         if(!empty($movieList)){
                              foreach($movieList as $movie)
                              {
                                   foreach ($array as $movie) 
                                   
                                   {?>
                                        <tr>
                                             <td><?php echo $movie->getTitle() ?></td>
                                             <td><?php echo $movie->getRelease_date() ?></td>
                                             <td><?php echo $movie->getOriginal_language() ?></td>
                                             <td><?php echo $movie->getOverview() ?></td>                                        
                                             <td><img src = "<?php echo ('https://image.tmdb.org/t/p/w500' . $movie->getPoster_path()) ?>" height="200" width="135"/></td>                                        </tr> 
                                        </tr> 
                                   <?php
                              }
                         }     
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