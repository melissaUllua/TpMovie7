<?php

    require_once('nav.php');

    use Models\Genre as Genre; 
    use DAO\GenreDAO as GenreDAO; 
    use DAOBD\GenreDAOBD as GenreDAOBD; 

    
    $genreDaoBD = new GenreDAOBD;
    $genreList =  $genreDaoBD->getAll();
    //var_dump($genreDaoBD);
    if (!isset($_GET['IdGenre'])){

?>
<main class="py-5">
    <form action="<?php echo FRONT_ROOT ?>Movie/ShowListViewByGenre" method="get">
        <section id="listado" class="mb-5">
            <div class="container">
                <h2 class="mb-4 message">Select genre</h2>

                <?php
                foreach($genreList as $genre){ ?>
                   <div class="row" style="width: 18rem;">
                            <div class="card-body">
                            <select name="Movies" id="">
                                <option value="<?php echo ($genre->getName());?>"></option>
                                <input type="hidden" name=<?php echo ($genre->getId())?>>
                                </select>
                            </div>
                        </div>
                        
                <?php } }?>

                </div>
        </section>
    </form>
</main>