<?php

    require_once('nav.php');

    use Models\Genre as Genre; 
    use DAO\GenreDAO as GenreDAO; 
    use DAOBD\GenreDAOBD as GenreDAOBD; 

    
    $genreDaoBD = new GenreDAOBD;
    $genreList =  $genreDaoBD->getAll();
    var_dump($genreDaoBD);
    if (!isset($_GET['IdGenre'])){

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

                                <a href="#" class="btn btn-info">Select genre</a>
                                <input type="hidden" name=<?php echo ($genre->getId())?>>
                            </div>
                        </div>
                        
                <?php } ?>

                <h2 class="mb-4">Select desired genre</h2>

                <?php
                foreach($genreList as $genre){ ?>
                    <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo ($genre->getName());?></h5>
                                <a href="#" class="btn btn-info">Select genre</a>
                                <input type="hidden" name="IdGenre" value="<?php echo ($genre->getId());?>">
                            </div>
                        </div>
                <?php } }?>

                </div>
        </section>
    </form>
</main>