<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>TP CINEMA</strong>
          
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowListView">Display Cinemas</a>
          </li>
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
         <?php } else { ?>
                <?php if ($_SESSION['isAdmin'] == true) { ?>
                         <li class="nav-item ">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Add Cinemas</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowEditView">Edit Cinemas</a>
                         </li>   
               <?php    }  ?>
               <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowLogOutView">Log Out</a>
               </li> 
    <?php }?>
          
     </ul>
</nav>