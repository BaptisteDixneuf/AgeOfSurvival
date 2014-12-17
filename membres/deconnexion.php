<?php

session_start();

session_unset();

session_destroy();
?>
<?php

$description_de_la_page = "Age of Survival";

$mot_cle_de_la_page = "Age of Survival,serveur,actualitÃ©,news,index,accueil,bienvenue,vidÃ©o,events,calendrier";

$auteur_de_la_page = "Dixneuf Baptiste";

$titre = "Deconnexion - Age of Survival";

require("../include/entete.php"); 

?>

<div  class="row">


  <div class="twelve columns">
     <div class="panel">
						<div class="page-header">
				    		<h1> Déconnexion </h1>
				     </div>
		  
   <p> Déconnexion en cours ....</p>
   <p>  Déconnexion fini.</p> 
 <a class="success radius button" href="<?php echo URLRACINE; ?>">Retour à la page d'accueil du site</a>
   

</div>

</div>

</div>








<!-- Pied de page
          ================================================== -->
          
          
               
        <?php include("../include/pieddepage.php"); ?> 
 
  
      </div>    
</body>
</html>