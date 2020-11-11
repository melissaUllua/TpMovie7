<?php
     require_once('nav.php');

    use Models\Genre as Genre; 

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
           
                <h2 class="mb-4 message">Select genre</h2>
               <div class= "container-fluid bg-light-alpha pt-3 pb-3 pl-5 pr-5">
                <form action="<?php echo FRONT_ROOT."Movie/ShowListViewByGenre"?>" method="get" >
                    <div class="row">
                             <div class="form-group">
                             <select name="idGenre" id=""class="form-control">
                             <?php
                                 foreach($genreList as $genre){
                                ?>
                                
                                <option class= "control-form" value="<?php echo $genre->getId(); ?>"><?php echo $genre->getName();?></option>
                                 <?php } ?>
                                 <option class= "control-form" value="0"><?php echo ("View all");?></option>
                                 </select>
                             </div>
                             <button type="submit" class="btn btn-dark ml-auto">Select</button>
                         </div>                
                         </form>
                </div>
                                 </div>
        </section>
  
</main>