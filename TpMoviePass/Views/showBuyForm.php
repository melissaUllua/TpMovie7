<?php ///falta modificar
    require_once('nav.php');
    use Models\Cinema as Cinema;
     //$userId = $_SESSION['userId'];
     //var_dump($userId);
    if((isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1))){
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
               <h2 class="mb-4">Confirm Purchase </h2>
               <?php
              // var_dump($cinemaID); 
               //for($i=0 ; $i < $totalRooms ; $i++){ ?>
               <form action="<?php echo FRONT_ROOT."Purchase/Add/"?>" method="post" class="bg-light-alpha p-5">
                    <div class="row">  

                             <input type="hidden" name="ShowId" value = "<?php echo $Show->getShowId(); ?>" required>
                         
                    <div class="form-group CVV">
                             <label for="cvv">Amount of seats</label>
                             <input type="number" class="form-control" name="Seats" min="1" required>
                         </div>                    
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Owner</label>
                                   <input type="text" name="owner" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Card number</label>
                                   <input type="text" name="cardNumber" value="" class="form-control" maxlength="16" required>
                              </div>
                         </div>
                         <div class="form-group">
                             <label for="cvv">CVV</label>
                             <input type="text" class="form-control" name="Cvv" maxlength="3" required>
                         </div>
                         <div class="col-lg-4">
                                   <label for="">Expiration date</label>
                            <select name="ExpMonth" id=""  class="form-control" required>
                                <option value="01">January</option>
                                <option value="02">February </option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select class="form-control" name="ExpYear" id="" required>
                                <option value="2020"> 2020</option>
                                <option value="2021"> 2021</option>
                                <option value="2022"> 2022</option>
                                <option value="2023"> 2023</option>
                                <option value="2024"> 2024</option>
                                <option value="2025"> 2025</option>
                            </select>
                              </div>
                         </div>
                         <input type="hidden" value="<?php $userId; ?>" name="IdUser">
                        
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add</button>
               <?php /*} llave del for each*/?>
               </form>
          </div>
          <?php   } else {  ?> <p class= "message"> You are not authorized to view this section <?php }?>
     </section>
</main>