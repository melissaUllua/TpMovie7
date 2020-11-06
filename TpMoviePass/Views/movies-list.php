<?php
<<<<<<< HEAD

    require_once('nav.php');

    use Models\Movie as Movie; 
    use DAO\MovieDAO as MovieDAO; 
    use Models\Genre as Genre; 
    use DAO\GenreDAO as GenreDAO; 
    
    $movieDao = new MovieDAO;
    $movieList =  $movieDao->getAll();
    $genreDao = new GenreDAO;
    $genreList =  $genreDao->getAll();

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
                                             <td><button type="submit" class="btn btn-dark ml-auto d-block"type="hidden" value="<?php echo ($movie->getId())?> (">Add movie to Database</button></tr> 
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
=======
     require_once('nav.php');

    use Models\Genre as Genre; 

?>
<main class="py-5">
    <form action="<?php echo FRONT_ROOT."Movie/ShowListViewByGenre"?>" method="get" class="bg-light-alpha p-5">
  
        <section id="listado" class="mb-5">
            <div class="container">
                <h2 class="mb-4">Select genre</h2>

               
                    <div class="row" style="width: 18rem;">
                             <div class="card-body">
                             <select name="idGenre" id=""class="form-control">
                             <?php
                        foreach($genreList as $genre){
                                var_dump($genre); ?>
                                <option value="<?php echo $genre->getId(); ?>"><?php echo $genre->getName();?></option>
                                 <?php }?>
                                 </select>
                             </div>
                         </div>
                         <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Select</button>
                         
                

                </div>
        </section>
    </form>
>>>>>>> 5c402a77a0c06e8b71fbc192c45a934bb609c258
</main>