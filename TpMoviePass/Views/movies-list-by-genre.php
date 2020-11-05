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
<div style="background-image: https://preview.pixlr.com/images/800wm/100/1/1001435035.jpg">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"></h2>
               <br>               <br>               <br>
               

                    <tbody>
                         <?php 
                         if(!empty($movieList)){

                              foreach($movieList as $movie)
                              {
                                   ?>
                                             <meta name="viewport" content="width=device-width, initial-scale=1">
                                             <style>
                                             .card {
                                             box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                                             transition: 0.3s;
                                             width: 20%;
                                             }

                                             .card:hover {
                                             box-shadow: 0 8px 160px 0 rgba(0,0,0,0.2);
                                             }

                                             .container {
                                             display: flex;
                                             justify-content: space-between;
                                             border-style: solid;
                                             border-width: 1px;
                                             margin-left: 0px;
                                             margin-right: 0px;
                                             flex-direction: row;
                                             flex-wrap: wrap;
                                             padding: 2px 16px;
                                             }
                                             .flex-container {
                                             width: 100%;
                                             height: 250px;
                                             background-color: rgba(0, 0, 150, .3);
                                             text-align: center;
                                             }
                                             .flex-item {
                                             box-sizing: border-box;
                                             border: 1px solid #ddd;
                                             background-color: rgba(0, 150, 0, .3);
                                             display: inline-block;
                                             width: 150px;
                                             height: 250px;
                                             }
                                             .flex-item + .flex-item {
                                             margin-left: 2%;
                                             }
                                             </style>
                                             </head>
                                             <body>


                                             <br>

                                             <div class="card">
                                             <img src="<?php echo ('https://image.tmdb.org/t/p/w500' . $movie->getPoster_path()) ?>" alt="Avatar" style="width:100%">
                                             <div class="card:hover">
                                             <h4 style="text-align:center;"><b><?php echo $movie->getTitle() ?></b></h4>                <br>
                                             <p style="text-align:center;"><?php echo ($movie->getTitle()) ?></p>
                                             </div>
                                             </div>
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