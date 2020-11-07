<?php

    require_once('nav.php');

    use Models\Movie as Movie; 
    //use DAO\MovieDAOBD as MovieDAOBD; 
    use Models\Genre as Genre; 
    //use DAO\GenreDAOBD as GenreDAOBD; 
    
    $idGenreShown = $_GET;
 
   


    //getMoviesByIdGenre($idGenre)

?>
<main>
<?php  if(isset($message))
               {
                    echo $message;
               }  
               ?>
<div style="background-image: https://preview.pixlr.com/images/800wm/100/1/1001435035.jpg">
     <section id="listado" class="mb-5">
     
     <h2 class="bg-light-alpha p-5"><?php if ($genreSelected == null) { echo "Displaying all movies";}else{echo $genreSelected->getName();} ?></h2>
          <div class="containerMovies">
               
               <br>               <br>               <br>

                         <?php 
                         if(!empty($movieList)){

                              foreach($movieList as $movie)
                              {
                                   ?>
                                             <br>

                                             <div class="card">
                                             <img src="<?php echo ('https://image.tmdb.org/t/p/w500' . $movie->getPoster_path()) ?>" alt="Avatar" style="width:99%" style="height:60%">
                                             <div class="card:hover">
                                             <h4><b><?php echo $movie->getTitle() ?></b></h4>                <br>
                                             <?php echo ("Duration: " . $movie->getDuration() . " minutes.") ?>
                                             <?php echo ("Language: " . $movie->getOriginal_language()) ?>
                                             <?php echo ("Release date: " . $movie->getRelease_date()) ?>

                                             </div>
                                             </div>
                                   <?php
                              }
                         }else{
                              ?>
                              <h4 style="text-align:center;"><b><?php echo ("Sorry! There are no movies of this genre") ?></b></h4>
                         <?php
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