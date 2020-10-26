<?php require_once('nav.php'); 
use Models\Cinema as Cinema;

    use DAO\CinemaDao as CineDao;
    $cineDao = new CineDao();

    $allCinemas = $cineDao->getAll()
    
?>

<main class="py-5">
    
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white "> Editar</h2>
        <form action="<?php /*echo FRONT_ROOT ?>Cinema/edit*/?>" method="POST"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>
                <th>Cine</th>
                 <td>
                 <select name="id" id="" class="form-control">
                            <option value="">--Selecciona un Cine--</option>

                            <?php 
                        if(isset($allCinemas)){
                            foreach ($allCinemas as $cinema){ 
                                   
                                echo "<option value=".$cinema->getCinemaId().">".$cinema->getCinemaName()."</option>";
                            }
                        }
                        ?><br>
                        </select>
                        <input type="text" name="cinemaName" placeholder = "Nombre del cine"> <br> <br>
                        <input type="text" name="ticketPrice" placeholder = "Valor de la entrada"> <br> <br>
                        <input type="text" name = "totalCapacity" placeholder= "Capacidad total"> <br><br>
                        <input type="text" name= "adress" placeholder= "Direccion"> <br>

                </td>
           
             </tr>
                
              </table>
          <br>
          <div>
          
            <input type="submit" class="btn btn-primary" value="Modificar" >
          </div>
        </form>
      
    </div>
     </section>
</main>