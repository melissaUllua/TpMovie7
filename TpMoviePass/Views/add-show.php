<?php ///falta modificar
    require_once('nav.php');
    //use Models\Movie as Movie;
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <?php 
               if(isset($message))
               {
                    echo $message;
               }                                                                                                                                                                                                                                                                                                                                                                                                                              
          ?>
               <h2 class="mb-4">Add Movie Show</h2>

               
               <form action="<?php echo FRONT_ROOT."Show/ShowListView/"?>" method="get" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Movies</label>
                                   <!-- agregar el foreach con las peliculas -->
                                   <select name="movieID" id="" class="form-control">
                                   <?php foreach ($movieList as $movie){ ?>
                                   <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle();?></option>
                                   <?php } ?>
                                   </select>
                              </div>
                              </div>
                         </div>
               
                        
                         <div class="col-lg-4">
                              <div class="form-group">
                              <label for="">Date</label>
                                   <input type="date" name="showDate" value="" min="" max="" class="form-control" required>

                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Time</label>
                                   <input type="dateTime" name="showTime" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <input type="hidden" name="roomID" value="<?php echo $room->getRoomId(); ?>" class="form-control"required>
                                   
                              </div>
                         </div>
                    
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add</button>
               
               </form>
          </div>
     </section>
</main>