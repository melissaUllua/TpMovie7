<?php

    require_once('nav.php');

    use Models\Genre as Genre; 
    use DAO\GenreDAO as GenreDAO; 
    
    $genreDao = new GenreDAO;
    $genreList =  $genreDao->getAll();

?>
<main class="py-5">
    <form action="<?php echo FRONT_ROOT ?>Movie/ShowListView" method="get">
        <section id="listado" class="mb-5">
            <div class="container">
                <h2 class="mb-4">Select genre</h2>

                <?php
                foreach($genreList as $genre){ ?>
                   <div class="row" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo ($genre->getName());?></h5>
                                <a href="#" class="btn btn-dark ml-auto d-block">Select</a>
                                <input type="hidden" name=<?php echo $genre->getId()?>>
                            </div>
                        </div>
                        
                <?php } ?>
                </div>
        </section>
    </form>
</main>