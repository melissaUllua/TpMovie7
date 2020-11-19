<?php 
require_once('nav.php');
use Models\Movie as Movie;
use Models\Cinema as Cinema;
use DAOBD\PurchaseDAOBD as PurchaseDAOBD;



?>
<main class="py-5 text-white">
    <h1></h1>
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb- message">Shows</h2>
            <?php  if(isset($message))
               {
                    ?> <p class="message-small"> <?php echo $message; ?> </p>
            <?php   
               }   
               ?>
            <table class="table bg-light-alpha">
                <thead>
                    <!-- <th>ID</th> -->
                    <th>Movie</th>
                    <th>Cinema</th>
                    <th>Room</th>
                    <th>Show date</th>
                    <th>Show time</th>
                    <?php  if(isset($_SESSION['isAdmin'])){ ?>
                    <th>Buy Tickets</th>
                    <?php } 
                   if((isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1))){ ?>
                    <th>Delete Show</th>
                    <th>Total </th>
                    <?php } ?>

                </thead>
                <tbody>
                    <?php 
                          foreach($showList as $show)
                          {
                           ?>
                    <tr>

                        <td> <?php 
                                   $movie = new Movie();
                                   $movie = $show->getShowMovie();
                                    $cinema =  $show->getShowRoom()->getRoomCinema();

                                   echo $movie->getTitle(); ?></td>
                        <td><?php echo $cinema->getCinemaName(); ?></td>
                        <td><?php echo $show->getShowRoom()->getRoomName(); ?></td>
                        <td><?php echo $show->getShowDate(); ?></td>
                        <td><?php echo $show->getShowTime(); ?></td>
                        </td>
                        <?php  if(isset($_SESSION['isAdmin'])){ ?>
                        <td>
                            <form action="<?php echo FRONT_ROOT."Purchase/ShowBuyView/"?>" method="POST" class="mb-5">

                                <input type="hidden" name="ShowId" , value="<?php echo $show->getShowId() ?>">

                                <button type="submit" name="button" class="btn btn-dark ml-auto">Buy
                                    Tickets</button>
                            </form>
                        </td>

                        <?php if($_SESSION['isAdmin'] == 1){ ?>
                        <td>
                            <form action="<?php echo FRONT_ROOT."Show/DeleteShow/".$show->getShowId();?>" method="get"
                                class="mb-5">
                                <input type="hidden" value="<?php echo $show->getShowId();?>" name="IdShow">
                                <button type="submit" name="button" class="btn btn-dark ml-auto">Delete
                                    Show</button>
                            </form>
                        </td>
                        <?php if($_SESSION['isAdmin'] == 1){ ?>
                        <td>
                           <?php echo ($purchase->TotalSeatsByShow($show->getShowId()) . "/" . $show->getShowRoom()->getRoomCapacity()) ?>
                           
                        </td>
                        <?php } ?>


                        <?php }
                              }
                            }
                         ?>
                </tbody>
            </table>
        </div>
    </section>
</main>