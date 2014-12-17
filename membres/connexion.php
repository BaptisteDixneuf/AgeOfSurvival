

<?php
                        
// on teste si le visiteur a soumis le formulaire de connexion
 if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {   // Si les variables sont postes     
 
 //Liste das variables et sécurisation
            //Fonction sécurisation des variables
                 
                              
                          function securite_variable($string)
                          {
                            // On regarde si le type de string est un nombre entier (int)
                            if(ctype_digit($string))
                            {
                              $string = intval($string);
                            }
                            // Pour tous les autres types
                            else
                            {
                              $string = htmlentities($string);
                              $string = addcslashes($string, '%_');
                            }
                            
                            return $string;
                          }
                       

                      //Sécurisation des variables passés 
                            $_POST['login']=securite_variable($_POST['login']);
                            $_POST['pass']=securite_variable($_POST['pass']);
  
// Si on tente de s'identifier
if(!empty($_POST['login']) AND !empty($_POST['pass']))
{
     //connexion à la bdd
                   
                    //Si $_SERVER["DOCUMENT_ROOT"] contient '/' en dernier caractère $doc_root contient $_SERVER["DOCUMENT_ROOT"] - le '/', 
                   // sinon $doc_root contient $_SERVER["DOCUMENT_ROOT"]
                  
                    $doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];
                    require($doc_root."/connect/connect2.php");


                     $verifications = mysql_query('SELECT nom_de_compte, mot_de_passe FROM membres WHERE nom_de_compte = \''.mysql_real_escape_string($_POST['login']).'\' ');

                            $data_verif = mysql_fetch_assoc($verifications);

                            // Si le pseudo existe bien
                            if(!empty($data_verif['nom_de_compte']))
                            {
                                 $erreur1 = $data_verif['mot_de_passe'];
                                 $erreur2 = $_POST['pass'];

                                   // Si le mot de passe est bon
                                   if($data_verif['mot_de_passe'] == trim(md5($_POST['pass'])))
                                   {
                                       //------------------------------------------------
                                       // Ici Votre script qui identifie le membre
                                       //------------------------------------------------
    
                                        session_start(); 
                                       $_SESSION['login'] = $_POST['login']; 
                                        $_SESSION['mot_de_passe'] = $_POST['pass'];
                                          $_SESSION['activation'] = "oui"; 
                           
                                        header('Location:http://ageofsurvival.koding.com'); 
    
                                   }
                                   // Si le mot de passe est faux
                                  else
                                   {
                                                                          
                                   $erreur =  'Mot de passe incorrect.';
                                   }

                            }
                            // Si le pseudo n'existe pas
                            else
                            {
                               $erreur =  'Pseudonyme incorrect.';
                            }


}
               
else { 
            $erreur = 'Erreur : Un des champs est vide.'; 
         }  
}  

?>

               
    	 
         
<?php
$description_de_la_page = "Age of Survival";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

 include("../include/entete.php"); ?>
<!-- Description du site
    ================================================== -->
    
    <div  class="row">
  <div class="seven columns">
     <div class="panel">
          <div class="page-header">
            <h1> Connexion à l'espace membre : </h1>
              Messagerie,avatar,...
            </div>
          
                  	
                  <?php
                  if (isset($erreur)) {
                  echo "<button class=\"alert radius button\" >" ;
                  echo "$erreur";  
                  
                  echo "</button>";
                  echo "</br></br>";
                  }


                  		
                  if ($_SESSION['activation'] == "oui"){
                  	echo "<button class=\"alert radius button\" >" ;
                    echo "Erreur : Vous êtes déjà connecté.";  
                  	echo "</button>";
                  	echo "</br></br>";
                  
                  	}
                    else{ 
                      ?>

                      <form class="well" action="connexion.php" method="post">
                      Nom de compte : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
                      Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
                      <input class="btn btn-success" type="submit" name="connexion" value="Connexion">
                      </form>  
                    <?php
                    }

                  ?>

                 

        </div> </div> 
       
        <div class="five columns">
        <div class="panel">
            <div class="page-header">
              <h1> Inscription: </h1>
              Rejoignez-nous!
              </div>

              <?php
              if ($_SESSION['activation'] == "oui"){
                    echo "<button class=\"alert radius button\" >" ;
                    echo "Erreur : Vous êtes déjà connecté. Le double compte est interdit.";  
                    echo "</button>";
                    echo "</br></br>";
                  
                    }
                    else{ 
                      ?>

                   <ul>
                              <li>Qualité</li>
                              <li>Qualité</li>
                              <li>Qualité</li>
                               <li>Qualité</li>
                          </ul>

                  <a class="btn btn-success" href="inscription.php">Page d'inscription</a>

                    <?php
                    }

                  ?>

                </div> </div> 
                          
          </div> 
    </div> 
</div>   

  
  
<!--  Footer
          ================================================== -->
          
    


<!-- Pied de page
          ================================================== -->
          
          
               
<?php include("../include/pieddepage.php"); ?> 
 
  
      </div>    
</body>
</html>
     
