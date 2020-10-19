<?php require_once('nav.php'); 
use Models\Cinema as Cinema;

    use DAO\CinemaDao as CineDao;
    //$cineDao = new CineDao();

    //$allCinemas = $cineDao->getAll()
    
?>

<main class="py-5">
    
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white "> Editar</h2>
         <?php 
            foreach ($cinemaList as $cinema){  ?>
        <form action="<?php echo FRONT_ROOT . "Cinema/edit/".$cinema->getCinemaId(); ?>" method="POST"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>
                <th>Cine</th>
                 <td>
                  <!--<select name="id" id="" class="form-control"> 
                           <option value="">--Selecciona un Cine--</option> -->
                            
                            
                        ?><br>
                        </select>
                        <input type="hidden" name="id" value="<?php echo $cinema->getCinemaId(); ?>">
                        <input type="text" value="<?php echo $cinema->getCinemaName(); ?>" name="cinemaName" placeholder = "Nombre del cine">
                        <input type="text" value="<?php echo $cinema->getCinemaAddress(); ?>" name= "cinemaAddress"  placeholder= "Direccion" class="mt-3">
                        <input type="number" value="<?php echo $cinema->getCinemaTotalCapacity(); ?>" name = "cinemaTotalCapacity"  placeholder= "Capacidad total" class="mt-3" min="0"> 
                        <input type="number" value="<?php echo $cinema->getCinemaTicketPrice(); ?>" name="cinemaTicketPrice" placeholder = "Valor de la entrada"min="0" class="mt-3"> 
                        
                        <br><label for=""> Estado de cine</label>
                        <select name="cinemaAvailabiity" id="" class="form-control">
                        <option value="<?= $cinema->getCinemaAvailability();?>"></option>
                          <option value="true">Disponible</option>
                          <option value="false">No disponible</option>
                          </select>
                          
                       <!-- </select> -->
                        
                 </td>
           
             </tr>
                
              </table>
          <br>
          <div>
          
            <input type="submit" class="btn btn-primary" value="Modificar" >

          </div>
        </form>
      <?php  } ?>
    </div>
     </section>
</main>