<?php

$description_de_la_page = "Age of Survival";

$mot_cle_de_la_page = "Age of Survival,serveur,actualitÃ©,news,index,accueil,bienvenue,vidÃ©o,events,calendrier";

$auteur_de_la_page = "Dixneuf Baptiste";

$titre = "Inscription - Age of Survival";

require("../include/entete.php"); 

?>


	<div  class="row">
  <div class="twelve columns">
     <div class="panel">

     <div class="page-header">
    <h1>Formulaire d'inscription</h1>
      
    </div>


<?php
 
 $IP = $_SERVER["REMOTE_ADDR"];
  
  
  $Date = date('Y-m-d', mktime(date('H')+6, date('i'), date('s') , date('m'), date('d'), date('Y')));
 
  
$doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];

  require($doc_root . "/connect/connect3.php");
     
    // On récupère tout le contenu de la table Liste_IP
    $reponse = $bdd->query('SELECT * FROM liste_ip_inscription WHERE IP=\'' . $IP . '\' AND Date=\'' . $Date . '\'');
  //On vérifie si l'IP est déja répertoriée
  while ($donnees = $reponse->fetch())
  {
    if($IP == $donnees['IP'])
      {
  $Messages_bdd=$donnees['Messages'];
      if ($Messages_bdd > 4){
      echo "Vous avez ateint votre limite de création de comptes pour aujourd'hui.";
      echo "</div>";
  echo "</div>";
      echo "</div>";
    require("../include/pieddepage.php");
      exit;
      }
      }    
  }
     
  
  
  
  
  ?>
  <?php
      
  
    $reponse->closeCursor(); // Termine le traitement de la requête



  ?> 
  
  <?php
   if ($_SESSION['activation'] == "oui"){
                      echo "<button class=\"alert radius button\" >" ;
                    echo "Erreur : Vous êtes déjà connecté.";  
                  	echo "</button>";
                  	echo "</br></br>";
                  
                  	}
                    else{ 
                        ?>


<form action="validation.php" method="post" >
  <label>Nom de compte : </label><input type="text" name="nom_de_compte" placeholder="Votre nom de compte" size="30" maxlength="10"  required>
  <label>Mail : </label> <input type="email" name="mail" placeholder="Votre adresse mail" size="30" maxlength="50"required>
 <label>Mot de Passe : </label> <input type="password" name="mot_de_passe_1" placeholder="Votre mot de passe" size="30" maxlength="50"required>
 <label>Répétez le mot de passe : </label> <input type="password" name="mot_de_passe_2" placeholder="Votre mot de passe" size="30" maxlength="50"required>

       Veuillez indiquer le sexe de votre personnage dans le jeu : </br>
       <input type="radio" name="sexe" value="H" required  /> <label for="H">Homme</label>
       <input type="radio" name="sexe" value="F" required /> <label for="F">Femme</label>
          <input type="checkbox" name="reglement" id="reglement" required /> <label for="oui">J'accepte <a href="<?php echo URLRACINE; ?>mentionslegales.php">le règlement</a></label>
       

  <?php
require_once('recaptchalib.php'); // Vérifier que l'URL relative correspond à l'emplacement du fichier (adapter si nécessaire)
$publickey = "6LdGatMSAAAAALk6LzDyOnkVm3yw1cQBp1rs0iVf"; // Utiliser la clé que vous avez eu lors de l'inscription sur recaptcha.net
echo recaptcha_get_html($publickey); // Affiche le captcha
?><br>
  
      <input type="submit" name="inscription" value="Inscription">
</form>
<?php
                    }
    ?>

  </div>
  
    </div>
     
 </div>
 
 

	
<!-- Pied de page
          ================================================== -->
          
          
               
        <?php require("../include/pieddepage.php"); ?> 
 
  
      </div>    
</body>
</html>
