<?php

    require_once('nav.php');

    use Models\Movie as Movie; 
    //use DAO\MovieDAOBD as MovieDAOBD; 
    use Models\Genre as Genre; 
    //use DAO\GenreDAOBD as GenreDAOBD; 
    use Models\Show as Show; 

    
    //$idGenreShown = $_GET;
 
   


    //getMoviesByIdGenre($idGenre)

?>
<main>
<?php  if(isset($message))
               {
                    echo $message;
               }  
               ?>
     <section id="listado" class="mb-5">
     
     <h2 class="bg-light-alpha p-5" style="text-align:center;"><b><?php echo ("BILLBOARD") ?></b></h2>

          <div class="containerMovies">
               
               <br>               <br>               <br>

                         <?php 
                         if(!empty($showsList)){

                              foreach($showsList as $movie)
                              {
                                //var_dump($movie);

                                   ?>
                                        
                                             <div class="card" >
                                             <form action="<?php echo FRONT_ROOT . "Show/ShowListByMovie/".$movie->getId(); ?>" method="get">
                                             
                                             <img src="<?php echo ('https://image.tmdb.org/t/p/w500' . $movie->getPoster_path()) ?>" alt="Avatar" style="width:99%" style="height:60%">
                                             <div class="card:hover">
                                             <h4><b><?php echo $movie->getTitle() ?></b></h4>                <br>
                                             <?php echo ("Duration: " . $movie->getDuration() . " minutes.") ?><br>
                                             <?php echo ("Language: " . $movie->getOriginal_language()) ?><br>
                                             <?php echo ("Release date: " . $movie->getRelease_date()) ?><br>
                                             <?php echo ("Genre/s: ");
                                             $genresArray = array();
                                             $genresArray = $movie->getGenresArray();

                                             //var_dump($genresArray);
                                            foreach($genresArray as $genre){
                                                echo($genre->getName() . ". ");
                                            }
                                             
                                             ?><br><br>
                                             <input type="submit" class="btn btn-dark ml-auto" value="Select movie" >
                                             </div>

                                             </form>
                                             <div class="submit"></div>
                                             </div>
                                   <?php
                              }
                         }else{
                              ?>
                              <h4 style="text-align:center;"><b><?php echo ("Sorry! There are no movies on Billboard this week. Come back soon!") ?></b></h4>
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
          </div>
     </section>
</main>