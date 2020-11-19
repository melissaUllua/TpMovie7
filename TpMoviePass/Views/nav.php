<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong><a class="nav-link" href="<?php echo FRONT_ROOT ?>index.php">BILLBOARD</a></strong>
          
     </span>
     <ul class="navbar-nav ml-auto">
     
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Show/ShowAvailableListView">Next Shows</a>
          </li> 
         
         <?php if(empty($_SESSION)){?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowLogInView">Log In</a>
          </li>         
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowSignUpView">Sign Up</a>
          </li> 
     <ul>
         <?php } else { ?>
                <?php if ($_SESSION['isAdmin'] == true) { ?>
                <li>
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="Cinemas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cinemas</a>
 
                         <div class="dropdown-menu bg-dark" aria-labelledby="Cinemas">
                           <a class="dropdown-item text-white" href="<?php echo FRONT_ROOT ?>Cinema/ShowListView">Display Cinemas</a>
                           <a class="dropdown-item text-white" href="<?php echo FRONT_ROOT ?>Cinema/ShowEditView">Edit Cinemas</a>
                           <a class="dropdown-item text-white" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Add Cinemas</a>
                        </div>
                    </div>
                    </li> 
                    <li>
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="Consults" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Consults</a>
 
                         <div class="dropdown-menu bg-dark" aria-labelledby="Consults">
                           <a class="dropdown-item text-white" href="<?php echo FRONT_ROOT ?>Purchase/ShowConsultsByCinema">Consults by cinemas</a>
                           <a class="dropdown-item text-white" href="<?php echo FRONT_ROOT ?>Purchase/ShowConsultsByMovies">Consults by movies</a>
                </li> 
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ShowListView">Display Movies</a>
               </li>  
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ShowListView">Display Movies</a>
               </li>  
                           

               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/updateDatabases">Update Database</a>
               </li>
              
               <?php    }  ?>
               <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowProfileView">Profile</a>
               </li> 
               <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowLogOutView">Log Out</a>
               </li> 
    <?php }?>
          
     </ul>
</nav>