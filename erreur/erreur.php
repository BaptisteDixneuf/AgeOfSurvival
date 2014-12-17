<?php 
$description_de_la_page= "Erreur - Age of Survival";
$mot_cle_de_la_page="Age of Survival,serveur,jeu,ragnarock,erreur"; 
$auteur_de_la_page="Dixneuf Baptiste";
$titre= "ErreurAge of Survival";

require("../include/entete.php"); ?>


<div  class="row">
  <div class="twelve columns">
     <div class="panel">
     
     <div class="page-header">
      <h1> Page d'erreur </h1>
     
    </div>
                    
      
 


<?php

switch($_GET['erreur'])
{
   case '0':
   echo " Erreur 0";
    echo "</br>";
   echo 'Aucune erreur défini';
   case '400':
   echo " Erreur 400";
    echo "</br>";
   echo 'Échec de l\'analyse HTTP.';
   break;
   case '401':
   echo " Erreur 401";
    echo "</br>";
   echo 'Le pseudo ou le mot de passe n\'est pas correct !';
   break;
   case '402':
   echo " Erreur 402";
    echo "</br>";
   echo 'Le client doit reformuler sa demande avec les bonnes données de paiement.';
   break;
   case '403':
   echo " Erreur 403";
    echo "</br>";
   echo 'Requête interdite !';
    
   break;
   case '404':
   echo " Erreur 404";
    
    echo "</br>";
   echo 'La page n\'existe pas ou plus !';
   break;
   case '405':
   echo " Erreur 405";
   echo 'Méthode non autorisée.';
   break;
   case '500':
   echo " Erreur 500";
    echo "</br>";
   echo 'Erreur interne au serveur ou serveur saturé.';
   break;
   case '501':
   echo " Erreur 501";
    echo "</br>";
   echo 'Le serveur ne supporte pas le service demandé.';
   break;
   case '502':
   echo 'Mauvaise passerelle.';
   break;
   case '503':
   echo " Erreur 503";
    echo "</br>";
   echo ' Service indisponible.';
   break;
   case '504':
   echo " Erreur 504";
    echo "</br>";
   echo 'Trop de temps à la réponse.';
   break;
   case '505':
   echo " Erreur 505";
    echo "</br>";
   echo 'Version HTTP non supportée.';
   break;
   default:
   echo " Erreur de Erreur";
    echo "</br>";
   echo 'Erreur !';
}
?>
          <p></p>   <p></p>   
        </br> </br>
          <h2>Explication </h2>

          <p>Lorsque un visiteur essaye de voir une page qui n'existe pas sur un site, alors le serveur renvois une erreur pour le préciser. Voici une petit liste des explications probable explicant cette erreur:</p>

<p>La page web à peut-être été supprimée, déplacée ou renommée. Cela peut être vrai si la page était mal placée ou si elle proposait un contenu de mauvaise qualité.</p>
<p>Il y a peut-être eu une erreur dans un lien. Personne n'est à l'abris d'une erreur.</p>
<p>Vous avez peut-être essayé d'entrer une adresse manuellement dans votre navigateur. Sachez que ce n'est pas la meilleur des solutions, mais c'est très bien d'avoir essayé.</p>
           </br>

  <h2>Solution</h2>

<p>Maintenant que vous êtes ici, il vous reste quelques solutions:</p>

<p>Vous pouvez tout simplement retourner sur la page d'accueil.</p>
<p>Essayer de retaper l'adresse dans le navigateur correctement pour pouvoir accéder au contenu convenablement.</p>
          </div>
     </div>
     
</div>




<!-- Pied de page
          ================================================== -->
          
          
               
        <?php require("../include/pieddepage.php"); ?> 
 
  
      </div>    
</body>
</html>