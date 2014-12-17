<?php





function menu() {

    ?>

    <!--Menu
    ================================================== -->

   <nav class="top-bar">
    <ul>
      <!-- Title Area -->
       <div class="one columns">
             </div>
      <li class="name">
        <h1>
          <a href="<?php echo URLRACINE; ?>">
           Age of Survival
          </a>
        </h1>
      </li>
      <li class="toggle-topbar"><a href="#"></a></li>
    </ul>

    <section>
      <!-- Left Nav Section -->
      <ul class="left">
       
        <li class="has-dropdown">
          <a class="active" href="#">Espace membre</a>
          <ul class="dropdown">
            <li><a href="<?php echo URLRACINE; ?>membres/inscription.php">Inscription</a></li>
            <li><a href="<?php echo URLRACINE; ?>membres/connexion.php">Connexion</a></li>
             <li><a href="<?php echo URLRACINE; ?>membres/profil.php">Profil</a></li>
            <li><a href="<?php echo URLRACINE; ?>membres/deconnexion.php">Déconnexion</a></li>
            
          </ul>
        </li>

        

        <li class="has-dropdown">
          <a class="active" href="#">Jouer</a>
          <ul class="dropdown">
            <li><a href="<?php echo URLRACINE; ?>jeu/jeu.php">Jouer</a></li>
           
            
          </ul>
          
        </li>

        <li class="has-dropdown">
          <a class="active" href="#"> Autres</a>
          <ul class="dropdown">
            <li><a href="<?php echo URLRACINE; ?>forum">Forum</a></li>
            <li><a href="<?php echo URLRACINE; ?>histoire.php">l'histoire du monde</a></li>
			<li><a href="<?php echo URLRACINE; ?>debuter.php">Bien débuter !</a></li>
            
          </ul>
        </li>

      </ul>

      <!-- Right Nav Section -->
      <ul class="right">
          



                    <a href="<?php echo URL_PAGE_FACEBOOK; ?>">

                        <img class="marge_haut" src="<?php echo URLRACINE; ?>images/reseau/facebook.png" alt="facebook"></a>



                    <a href="<?php echo URL_PAGE_TWITTER; ?>">

                        <img class="marge_haut" src="<?php echo URLRACINE; ?>images/reseau/twitter.png" alt="twitter"></a>



                    <a href="<?php echo URL_PAGE_GOOGLE; ?>" rel="publisher" style="text-decoration:none;">

                        <img class="marge_haut" width src="<?php echo URLRACINE; ?>images/reseau/gplus-32.png" alt="google+" style="border:0;width:32px;height:32px;"/></a>



                 

      </ul>


    </section>
  </nav>

                <?php

            }

            ?>
   