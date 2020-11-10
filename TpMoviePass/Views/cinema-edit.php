<?php require_once('nav.php'); 
use Models\Cinema as Cinema;

    use DAOBD\CinemaDAOBD as CineDAOBD;
    //$cineDao = new CineDao();

    //$allCinemas = $cineDao->getAll()
    if((isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1))){
?>

<main class="py-5">
    
     <section id="listado" class="mb-5">
        <div class="container">    
        <h2 class="mb-4 text-center">Edit</h2>
         <?php 
           if(isset($message))
            {
                 echo $message;
            }  
          
            foreach ($cinemaList as $cinema){  ?>
        <form action="<?php echo FRONT_ROOT . "Cinema/Edit/".$cinema->getCinemaId(); ?>" method="POST" class="p-5" >
          <table class="table bg-light-alpha"> 
          <th class= "message"><?php echo $cinema->getCinemaName(); ?></th>
              <tr>
                     
                     <td>
                        <input type="hidden" name="id" value="<?php echo $cinema->getCinemaId(); ?>">
                        <label for=""> <strong>Current Name </strong></label>
                        <input class="form-control mb-3" type="text" value="<?php echo $cinema->getCinemaName(); ?>" name="cinemaName" placeholder = "Cinema Name">
                        <label for=""><strong> Current Address </strong></label>
                        <input class="form-control" type="text" value="<?php echo $cinema->getCinemaAddress(); ?>" name= "cinemaAddress"  placeholder= "Address" class="mt-3">
                        <br>
                        <label for=""><strong>Current Availability </strong></label> <br>
                        <input type="hidden" value="<?= $cinema->getCinemaAvailability();?>"></option>
                        <input type="radio" id="Available" value="1" name="cinemaAvailability" <?php if ($cinema->getCinemaAvailability() == true) echo "checked" ?>>
                        <label for="Available" >Available</label>
                        <input type="radio" id="Unavailable" value="0" name="cinemaAvailability" <?php if ($cinema->getCinemaAvailability() == false) echo "checked" ?>>
                        <label for="Unavailable">Unavailable</label>
                        <br>
                        <input type="submit" class="btn btn-dark mb-3" value="Save Changes" >

                        </form>
                        <br>
                        <form action="<?php echo FRONT_ROOT."Room/ShowAddView/".$cinema->getCinemaId();?>" method="get" class="mb-5">
                          <input type="hidden" value="<?php echo $cinema->getCinemaId();?>" name="IdCinema">
                          <button type="submit" name="button" class="btn btn-dark">Add Room</button>
                        </form>      
                      </td>
              </tr>
          </table>
          

  

      <?php  } } else {  ?> <p class= "message flex-item"> You are not authorized to view this section <?php }?>
      
     </section>
</main>