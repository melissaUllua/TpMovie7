<?php
     require_once('nav.php');

    use Models\Genre as Genre; 

?>
<main class="py-5">
<?php  if(isset($message))
               {
                    echo $message;
               }  
               ?>
    <form action="<?php echo FRONT_ROOT."Movie/ShowListViewByGenre"?>" method="get" class="bg-light-alpha p-5">
    
        <section id="listado" class="mb-5">
            <div class="container">
           
                <h2 class="mb-4">Select genre</h2>

               
                    <div class="row" style="width: 18rem;">
                             <div class="card-body">
                             <select name="idGenre" id=""class="form-control">
                             <?php
                        foreach($genreList as $genre){
                                ?>
                                <option value="<?php echo $genre->getId(); ?>"><?php echo $genre->getName();?></option>
                                 <?php } ?>
                                 <option value="0"><?php echo ("View all");?></option>
                                 </select>
                             </div>
                         </div>
                         <button type="submit" class="btn btn-dark ml-auto d-block">Select</button>
                         
                

                </div>
        </section>
    </form>
</main>