<?php require_once('nav.php'); 
use Models\Cinema as Cinema;

    use DAOBD\CinemaDAOBD as CineDAOBD;
    //$cineDao = new CineDao();

    //$allCinemas = $cineDao->getAll()
    if((isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1))){
?>

<main class="py-5">

    <section id="listado">
        <h2 class="mb-4 message">Edit Cinemas</h2>
        <?php 
           if(isset($message))
            {
              ?> <p class="message-small"> <?php echo $message; ?> </p>
        <?php  
            }  
          
            foreach ($cinemaList as $cinema){  ?>

        <table class="table bg-light-alpha  ml-3 mr-3">
            <thead>
                <th class="message" colspan=5><?php echo $cinema->getCinemaName(); ?></th>
            </thead>
            <tbody>
                <tr>
                    <form action="<?php echo FRONT_ROOT . "Cinema/Edit/".$cinema->getCinemaId(); ?>" method="POST">


                        <input type="hidden" name="id" value="<?php echo $cinema->getCinemaId(); ?>">
                        <td class="form-group">
                            <label for=""> <strong>Current Name </strong></label>
                            <input class="form-control mb-3" type="text" value="<?php echo $cinema->getCinemaName(); ?>"
                                name="cinemaName" placeholder="Cinema Name">
                        </td>
                        <td class="form-group">
                            <label for=""><strong> Current Address </strong></label>
                            <input class="form-control" type="text" value="<?php echo $cinema->getCinemaAddress(); ?>"
                                name="cinemaAddress" placeholder="Address" class="mt-3">

                        </td>
                        <td class="form-group">

                            <label for=""><strong>Current Availability </strong></label> <br>
                            <input type="hidden" value="<?= $cinema->getCinemaAvailability();?>"></option>
                            <input type="radio" id="Available" value="1" name="cinemaAvailability"
                                <?php if ($cinema->getCinemaAvailability() == true) echo "checked" ?>>
                            <label for="Available">Available</label>
                            <input type="radio" id="Unavailable" value="0" name="cinemaAvailability"
                                <?php if ($cinema->getCinemaAvailability() == false) echo "checked" ?>>
                            <label for="Unavailable">Unavailable</label>

                        </td>

                        <td class="form-group">
                            <input type="submit" class="btn btn-dark mb-3 ml-auto" value="Save Changes">
                        </td>
                    </form>

                    <td class="form-group">
                        <form action="<?php echo FRONT_ROOT."Room/ShowAddView/".$cinema->getCinemaId();?>" method="get">
                            <input type="hidden" value="<?php echo $cinema->getCinemaId();?>" name="IdCinema">
                            <button type="submit" name="button" class="btn btn-dark ml-3">Add Room</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php  } } else {  ?> <p class="message flex-item"> You are not authorized to view this section <?php }?>

    </section>
</main>