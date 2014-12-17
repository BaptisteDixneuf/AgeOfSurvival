<?php

$description_de_la_page = "Age of Survival";

$mot_cle_de_la_page = "Age of Survival,serveur,actualitÃ©,news,index,accueil,bienvenue,vidÃ©o,events,calendrier";

$auteur_de_la_page = "Dixneuf Baptiste";

$titre = "Validation formulaire - Age of Survival";

require("../include/entete.php"); 

?>


  <div  class="row">
  <div class="twelve columns">
     <div class="panel">

     <div class="page-header">
    <h1>Validation formulaire</h1>
      
    </div>
<?php
 
 $IP = $_SERVER["REMOTE_ADDR"];
  
  $Date = date('Y-m-d', mktime(date('H'), date('i'), date('s') , date('m'), date('d'), date('Y')));
 $Cherche_IP = "";
 $Date_comp = "";
 
  
$doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];

  require($doc_root . "/connect/connect3.php");
     
    // On récupère tout le contenu de la table Liste_IP
    $reponse = $bdd->query('SELECT * FROM liste_ip_inscription');
  
    //On vérifie si l'IP est déja répertoriée
  while ($donnees = $reponse->fetch())
  {
    if($IP == $donnees['IP'])
      {
        $Date_bdd = $donnees['Date'];
        $Messages_bdd = $donnees['Messages'];
        
        $Cherche_IP = "OK";
       
      }    
  }
  
  //Si l'IP n'est pas répertoriée, on l'insère
  if($Cherche_IP != "OK")
    {
      $Messages = 1;
      $req = $bdd->prepare('INSERT INTO liste_ip_inscription(IP, Date, Messages) VALUES(:IP, :Date, :Messages)');
      $req->execute(array(
      'IP' => $IP,
      'Date' => $Date,
      'Messages' => $Messages
      ));
    }    
    
  
    
  //Si elle l'est, on verifie si la date est la même qu'aujourd'hui
  if($Cherche_IP == "OK")
    {
       
      $Date=str_replace ( "/","-", $Date) ;
      
         
     
      if ($Date == $Date_bdd)
        {
          $Date_comp = "OK";
           
        }
    }
  
  //Si la date n'est pas identique
  if ($Date_comp != "OK")
    {
      $Messages = 0;      
      $req = $bdd->prepare('UPDATE liste_ip_inscription SET Date = :Date, Messages = :Messages WHERE IP = :IP');
      $req->execute(array(
      'IP' => $IP,
      'Date' => $Date,
      'Messages' => $Messages
      ));
    }
  
  //Si la date est identique
  if ($Date_comp == "OK")
    {
      $Messages = $Messages_bdd + 1;      
      $req = $bdd->prepare('UPDATE liste_ip_inscription SET Date = :Date, Messages = :Messages WHERE IP = :IP');
      $req->execute(array(
      'IP' => $IP,
      'Date' => $Date,
      'Messages' => $Messages
      ));
    }
  
 

  
    
  ?>
<?php
      
  
    $reponse->closeCursor(); // Termine le traitement de la requête

  ?>
  <?php
 
 $IP = $_SERVER["REMOTE_ADDR"];
  
  
  $Date = date('Y-m-d', mktime(date('H'), date('i'), date('s') , date('m'), date('d'), date('Y')));
 
  
  $doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];

  require($doc_root . "/connect/connect.php");
     
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
  //Détection si c'est un homme ou un robot
  require_once('recaptchalib.php'); // Ne pas réafficher cette ligne dans le cas où ce code est sur la même page que le formulaire
$privatekey = "6LdGatMSAAAAAFQMLXtiMmb0KEiSII-38buMfseq"; // Utiliser la clé privée qui est donnée sur votre compte recaptcha.net
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) { // Test si le captcha a bien été rempli
  // Si le captcha n'est pas valide
  echo 'Le captcha antispam n\'est pas valide. Veuillez recommencer.';
}
  else{ 
      
      
      //Script a éxécuté si le captcha est valide
    //Définition des variables et sécurisation des données envoyés
    $nom_de_compte=htmlspecialchars($_POST['nom_de_compte']);
    $mail=htmlspecialchars($_POST['mail']);
    $sexe=htmlspecialchars($_POST['sexe']);
    $mot_de_passe_1=htmlspecialchars($_POST['mot_de_passe_1']);
    $mot_de_passe_2=htmlspecialchars($_POST['mot_de_passe_2']);
    $reglement=htmlspecialchars($_POST['reglement']);

   

                // cette fonction vérifie que le formulaire a bien été rempli
                function remplissage($form_vars) {
                  // teste que chaque champ a une valeur
                  foreach ($form_vars as $key => $value) {
                     if ((!isset($key)) || ($value == '')) {
                        return false;
                        }
                      }
                    return true;  
                }
 
 
  // Vérifie que le formulaire a été rempli
    if (!remplissage($_POST)) {
      throw new Exception('Vous n\'avez pas rempli le formulaire correctement - Veuillez s\'il vous plaît revenir en arrière et essayez à nouveau.');
    }
 
  if ((strlen($nom_de_compte) < 4) || (strlen($nom_de_compte) > 16)) {
      throw new Exception('Votre mot de compte doit être compris entre 4 et 16 caractères. Veuillez s\'il vous plaît revenir en arrière et essayez à nouveau.');
    }
 
                // Cette fonction vérifie que l'adresse mail est valide
                function validation_email($address) {
                // Vérifie que l'adresse mail est probablement valide
                $Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
                if (preg_match($Syntaxe, $address)) {
                return true;
                } else {
                return false;
                }
                }
                
 
    // L'adresse mail n'est pas valide
    if (!validation_email($mail)) {
      throw new Exception('Ce n\' est pas une adresse email valide. Veuillez s\'il vous plaît revenir en arrière et essayez à nouveau.');
    }

              //Vérifier que le choix de sexe n'a pas été modifié
             function validation_sexe($sexe) {
              // Vérifie que l'adresse mail est probablement valide
               if ($sexe != "F" and $sexe != "H") {
                return false;
              } else {
                return true;
              }
            }
 
  //Test du champ sexe
  if (!validation_sexe($sexe))
{
    throw new Exception('Vous avez  modifié le choix du sexe - Veuillez s\'il vous plaît revenir en arrière et essayez à nouveau.');
}



    //Test pour savoir si les mots de passe sont identiques
   if ($mot_de_passe_1 != $mot_de_passe_2) {
      echo "Les deux mots de passe sont différents";
	  echo "</div>";
     include("../include/pied_de_page.php");
	  exit;
    }    
    
             //Fonction qui vérifie que le choix est bon
             function validation_reglement($reglement) {
              // Vérifie que l'adresse mail est probablement valide
               if ($reglement != "on") {
                return false;
              } else {
                return true;
              }
            }
            
     //Test du champ sexe
  if (!validation_reglement($reglement))
{
    throw new Exception('Vous avez  modifié le choix du règlement - Veuillez s\'il vous plaît revenir en arrière et essayer à nouveau.');
}

  $mot_de_passe_joueur = $mot_de_passe_1;
    //Encryptage du mot de passe
  $mot_de_passe_crypte= md5($mot_de_passe_joueur);
  
   //Date d'enregistrement
  $date=date('Y-m-d H:i:s');
  
  //Enregistrement en BD
  
     
      $doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];

      require($doc_root . "/connect/connect2.php");

      // on recherche si ce login est déjà utilisé par un autre membre
      $sql = 'SELECT count(*) FROM membres WHERE nom_de_compte="'.mysql_escape_string($nom_de_compte).'"';
      $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
      $data = mysql_fetch_array($req);
    
      // on recherche si ce mail est déjà utilisé par un autre membre
      $sql = 'SELECT count(*) FROM membres WHERE mail="'.mysql_escape_string($mail).'"';
      $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
      $data2 = mysql_fetch_array($req);
    
    // Insertion en Bd 
      if ($data[0] == 0 and $data2[0] == 0 ) {
        //Génénral
        $sql = 'INSERT INTO membres(nom_de_compte,mot_de_passe,mail,date_de_creation,sexe)VALUES( "'.mysql_escape_string($nom_de_compte).'", "'.mysql_escape_string($mot_de_passe_crypte).'", "'.mysql_escape_string($mail).'", "'.mysql_escape_string($date).'", "'.mysql_escape_string($sexe).'")';
        mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
        $map_abscisse=1;
        $map_ordonnee=1;
        $abscisse=1;
        $ordonnee=1;
        //Inventaire-jeu
        $sql2='INSERT INTO deplacement(pseudo,map_abscisse,map_ordonnee,abscisse,ordonnee) VALUES("'.mysql_escape_string($nom_de_compte).'",'.$map_abscisse.','.$map_ordonnee.','.$abscisse.','.$ordonnee.')';
        mysql_query($sql2) or die('Erreur SQL !'.$sql2.'<br />'.mysql_error());
        //Forum
        $sql3='INSERT INTO users(username, password, email, signup_date)  VALUES  ("'.mysql_escape_string($nom_de_compte).'", "'.mysql_escape_string($mot_de_passe_crypte).'", "'.mysql_escape_string($mail).'", "'.time().'")';
        mysql_query($sql3) or die('Erreur SQL !'.$sql3.'<br />'.mysql_error());

            echo "Votre inscription est valide. <br>
            Un mail va être envoyé d'ici quelques secondes pour vous rapeller vos identifiants de connexion au jeu.<br>
            Note : Il se peut que le mail soit stocké dans votre dossier de spams.<br>
            Note 2 : L'envoi du mail peut durer 10 minutes.<br>";
      }
      elseif ($data[0] != 0) {
         echo "Un membre possède déjà ce login.";
          echo "</div>";
     echo "</div>";
      echo "</div>";
    require("../include/pieddepage.php");
	  exit;
       } 
        elseif ($data2[0] != 0) {
          echo "Cette adresse email est déjà utilisé";
         echo "</div>";
     echo "</div>";
      echo "</div>";
    require("../include/pieddepage.php");
	  exit;
       } 
       
      
    
  //Envoie du mail
 
    $to = $mail; 
    $objet= 'Inscription sur Age Of Survival';
     $message = '<html>
          <head>
            <title>Inscription sur Age Of Survival</title>
          </head>
          
          <body>
            <div>Bienvenue sur le serveur!<br/>
            Vous avez complété une inscription à l\'instant.<br/>
             Votre nom de compte est : '.htmlspecialchars($nom_de_compte, ENT_QUOTES).'<br>
            Votre mot de passe est : '.htmlspecialchars($mot_de_passe_joueur, ENT_QUOTES).'<br>
            Veillez à le garder secret et à ne pas l\'oublier.<br/>
            Vous pouvez dès à présent accéder au jeu si il est téléchargé en rentrant le nom de compte et le mot de passe ci-dessus.<br/>
            En vous remerciant.<br/><br/>
            Age Of Survival.
          </body>
        </html>';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

     // En-têtes additionnels
        $headers .= 'From: noreply@ageofsurvival.fr' . "\r\n";


        $mail = mail($to, $objet, $message, $headers); //marche

        if($mail) echo '';
        else echo "<br>Une erreur est survenue lors de l'envoi du mail. Veuillez réessayer.";
 
   
  
   
}
  
  
  

?>

  <a class="success radius button" href="<?php echo URLRACINE; ?>">Revenir à l'accueil</a><br></div>

	</div>
    </div>
     
 </div>


  
<!-- Pied de page
          ================================================== -->
          
          
               
        <?php require("../include/pieddepage.php"); ?> 
 
  
      </div>    
</body>
</html>