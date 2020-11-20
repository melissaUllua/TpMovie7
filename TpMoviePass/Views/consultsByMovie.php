<?php
     require_once('nav.php');

    use Models\Movie as Movie; 

?>
<main class="py-5">
    <?php  if(isset($message))
               {
                    ?> <p class="message-small"> <?php echo $message; ?> </p>
    <?php   
               }   
               ?>


    <section id="listado" class="mb-5">
        <div class="container">

            <h2 class="mb-4 message">Select Movie</h2>
            <div class="container">
                <form action="<?php echo FRONT_ROOT."Purchase/ConsultByMovie"?>" method="get"
                    class="bg-light-alpha p-5">
                    <div class="row">
                        <div class="form-group col-lg-4">

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
                            <div class="form-group col-lg-4">
                                <label for=""><strong>Since</strong></label>
                                <input type="date" name="firstDate" value="" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for=""><strong>To</strong></label>
                                <input type="date" name="lastDate" value="" class="form-control" required>
                            </div>
                        
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Select</button>
                </form>
            </div>
        </div>
    </section>

</main>