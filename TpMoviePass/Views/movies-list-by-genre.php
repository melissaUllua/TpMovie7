<?php

    require_once('nav.php');

    use Models\Movie as Movie; 
    use DAO\MovieDAOBD as MovieDAOBD; 
    use Models\Genre as Genre; 
    use DAOBD\GenreDAOBD as GenreDAOBD; 
    
    $idGenreShown = $_GET;
 
    $genreDaoBD = new GenreDAOBD;
    $movieList =  $genreDaoBD->getMoviesByIdGenre($idGenreShown);


    getMoviesByIdGenre($idGenre)

?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Add movie from Movie List</h2>
               <h4 class="mb-4">Select genre</h4>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Title</th>
                         <th>Release date</th>
                         <th>Language </th>
                         <th>Overview</th>
                         <th>Duration</th>
                         <th>Poster</th>
                         <th>Add</th>
                    </thead>
                    <tbody>
                         <?php 
                         if(!empty($movieList)){

                              foreach($movieList as $movie)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $movie->getTitle() ?></td>
                                             <td><?php echo $movie->getRelease_date() ?></td>
                                             <td><?php echo $movie->getOriginal_language() ?></td>
                                             <td><?php echo $movie->getOverview() ?></td>                                        
                                             <td><?php echo $movie->getDuration() ?></td>                                        
                                             <td><img src = "<?php echo ('https://image.tmdb.org/t/p/w500' . $movie->getPoster_path()) ?>" title = "<?php echo ($movie->getTitle())?>" height="200" width="135"/></td>
                                             <td><button type="submit" class="btn btn-basic btn-lg" type="hidden" value="<?php echo ($movie->getId())?> (">Add movie to Database</button></tr> 
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