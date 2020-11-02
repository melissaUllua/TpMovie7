<?php require_once('nav.php'); 
use Models\Cinema as Cinema;

    use DAOBD\CinemaDAOBD as CineDAOBD;
    //$cineDao = new CineDao();

    //$allCinemas = $cineDao->getAll()
    
?>

<main class="py-5">
    
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white ">Edit</h2>
         <?php 
            foreach ($cinemaList as $cinema){  ?>
        <form action="<?php echo FRONT_ROOT . "Cinema/Edit/".$cinema->getCinemaId(); ?>" method="POST"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>
                <th><?php echo $cinema->getCinemaName(); ?></th>
                 <td>
                  <!--<select name="id" id="" class="form-control"> 
                           <option value="">--Selecciona un Cine--</option> -->
                        <br>
                        </select>
                        <input type="hidden" name="id" value="<?php echo $cinema->getCinemaId(); ?>">
                        <input type="text" value="<?php echo $cinema->getCinemaName(); ?>" name="cinemaName" placeholder = "Cinema Name">
                        <input type="text" value="<?php echo $cinema->getCinemaAddress(); ?>" name= "cinemaAddress"  placeholder= "Address" class="mt-3">
                        <input type="number" value="<?php echo $cinema->getCinemaTotalCapacity(); ?>" name = "cinemaTotalCapacity"  placeholder= "Total Capacity" class="mt-3" min="0"> 
                        <input type="number" value="<?php echo $cinema->getCinemaTicketPrice(); ?>" name="cinemaTicketPrice" placeholder = "Ticket Price"min="0" class="mt-3"> 
                        
                        <br><label for="">Cinema Status</label>
                        <select name="cinemaAvailabiity" id="" class="form-control">
                        <option value="<?= $cinema->getCinemaAvailability();?>"></option>
                        <option value="true">Available</option>
                        <option value="false">Not Available</option>
                        </select>
                      
    </div>     
                       <!-- </select> -->
                        
                 </td>
           
             </tr>
                
              </table>
                       <br>
          <div>
          
            <input type="submit" class="btn btn-dark ml-auto d-block" value="Save Changes" >

          </div>
          <br>
        </form>
        <td>
        <?php echo $IdCinema = $cinema->getCinemaId(); ?>
        <form action="<?php echo FRONT_ROOT."Room/ShowAddView/".$IdCinema?>" method="get" class="mb-5">
                            
           <?php//$cinemaSER = serialize($cinema); ?> 
                     <!-- <input type="hidden" name = "cinema", value= "<?php //$cinemaSER ?>"> -->
                      <input type="hidden" value="<?php $cinema->getCinemaId();?>" name="IdCinema">
           <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add Show Room</button>
           </form>
                          
                           
           </td>
      <?php  } ?>
      
     </section>
</main>