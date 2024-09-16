<?php
     require_once('nav.php');

    use Models\Cinema as Cinema; 

?>
<main class="py-5">
    <?php  if(isset($message))
               {
                    ?> <p class="message-small"> <?php //echo $message; ?> </p>
    <?php   
               }   
               ?>


    <section id="listado" class="mb-5">
        <div class="container">

            <h2 class="mb-4 message">Select Movie</h2>
            <div class="container-fluid bg-light-alpha pt-3 pb-3 pl-5 pr-5">
                <form action="<?php echo FRONT_ROOT."Purchase/ConsultByMovie"?>" method="get">
                    <div class="row">
                        
                        
                        <div class="form-group col-lg-3">
                            <label for=""><strong>Select Movie</strong></label>
                            <select name="IdMovie" id="" class="form-control">
                                <?php
                                 foreach($movieList as $movie){

                                ?>

                                <option class="form-control" value="<?php echo $movie->getId(); ?>">
                                    <?php echo $movie->getTitle();?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for=""><strong>Since</strong></label>
                            <input type="date" name="firstDate" value="" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for=""><strong>To</strong></label>
                            <input type="date" name="lastDate" value="" class="form-control" required>
                        </div>
                        <div class="col-lg-3">
                        <label for=""></label>
                        <label for=""></label>
                        <button type="submit" class="btn btn-dark ml-auto btn-block d-block">Select</button>
                        </div>
                        
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        <?php if(isset($TotalIncome))
                            { if($TotalIncome == 0)
                                { ?>
                                    <p class= "alert alert-primary" >Total income: $ 0</p>
                                    
                                <?php } else { ?>
                         
                           <p class= "alert alert-primary" >Total income: $ <?php echo $TotalIncome; ?></p>
                       <?php  } } ?>
                        </div>
                       
                    </div>
                    

                </form>
            </div>
        </div>
    </section>

</main>