<?php
     require_once('nav.php');

    use Models\Movie as Movie; 

?>
<main class="py-5">
<?php  if(isset($message))
               {
                    ?> <p class= "message-small"> <?php echo $message; ?> </p>
                    <?php   
               }   
               ?>
    
    
        <section id="listado" class="mb-5">
            <div class="container">
           
                <h2 class="mb-4 message">Select Movie</h2>
               <div class= "container-fluid bg-light-alpha pt-3 pb-3 pl-5 pr-5">
                <form action="<?php echo FRONT_ROOT."Purchase/ConsultByMovie"?>" method="get" >
                    <div class="row">
                             <div class="form-group">
                             <select name="IdMovie" id=""class="form-control">
                             <?php
                                 foreach($movieList as $movie){
                                ?>
                             
                                <option class= "control-form" value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle();?></option>
                                 <?php } ?>
                              
                                </select>
                                <div class="form-group">
                                   <label for=""><strong>Since</strong></label>
                                   <input type="date" name="firstDate" value="" class="control-form" required>
                              </div>
                              <div class="form-group">
                                   <label for=""><strong>To</strong></label>
                                   <input type="date" name="lastDate" value="" class="control-form" required>
                              </div>
                             </div>
                             <button type="submit" class="btn btn-dark ml-auto">Select</button>
                         </div>                
                         </form>
                </div>
                                 </div>
        </section>
  
</main>