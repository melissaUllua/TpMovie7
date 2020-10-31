<?php

    require_once('nav.php');

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
          </div>
     </section>
</main>