<?php
    require_once('nav.php');
    //require "Config/Autoload.php";

    use Models\Cinema as Cinema; 
?>
<main class="py-5">
     <h1></h1>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Precio de la entrada</th>
                         <th>Capacidad total</th>
                         <th>Direccion </th>
                         <th>Estado de cine</th>
                         
                    </thead>
                    <tbody>
                         <?php 
                              foreach($cinemaList as $cinema)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getCinemaName() ?></td>
                                             <td><?php echo $cinema->getCinemaTicketPrice() ?></td>
                                             <td><?php echo $cinema->getCinemaTotalCapacity() ?></td>
                                             <td><?php echo $cinema->getCinemaAddress() ?></td>
                                             <td><?php if($cinema->getCinemaAvailability() == true)
                                             {
                                                  echo "Disponible";
                                             }
                                             else
                                             {
                                                  echo "No disponible";
                                             }
                                             ?></td>
                                            
                                        </tr> 
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table> 
          </div>
     </section>
</main>