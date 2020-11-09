<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong><a class="nav-link" href="<?php echo FRONT_ROOT ?>index.php">TP CINEMA</a></strong>
          
     </span>
     <ul class="navbar-nav ml-auto">
     
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ShowListView">Display Movies</a>
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
              <!--  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="Cinemas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cinemas</button>
                    <div class="dropdown-menu navbar-dark bg-dark navbar-text" aria-labelledby="Cinemas">
                         <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Cinema/ShowListView">Display Cinemas</a>
                         <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Cinema/ShowEditView">Edit Cinemas</a>
                         <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Add Cinemas</a>
                    </div>
               </div>
               -->
                   
                <!--<div class="dropdown-divider"></div>  <ul class= "dropdown"> 
                <li class="">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowListView">Display Cinemas</a>
               </li>
               <li class="nav-item">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowEditView">Edit Cinemas</a>
               </li> 
                <li class="nav-item ">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Add Cinemas</a>
               </li>
                </ul>
                </li>
                -->
                  
                   
                       
                        <!-- <li class="nav-item ">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Room/ShowAddView">Add Show Room</a>
                         </li>
                         LAS SALAS SE AGREGAN DESDE EDITAR CINES 
                         -->
                        
                         
                           

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