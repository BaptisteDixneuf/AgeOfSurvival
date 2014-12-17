<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
  

?>

<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<!--[if IE]>
    <script type="text/javascript">
  document.createElement("header");
  document.createElement("footer");
  document.createElement("section");
  document.createElement("aside");
  document.createElement("nav");
  document.createElement("article");
  document.createElement("figure");
  document.createElement("figcaption");
    </script>
<![endif]-->

<!--Declaration de constante

================================================== -->

<?php

define("URLRACINE","http://ageofsurvival.koding.com/");

define("URL_PAGE_FACEBOOK","https://www.facebook.com/AgeOfSurvival");

define("URL_PAGE_GOOGLE","https://plus.google.com/108314104965947318926/pos");

define("URL_PAGE_TWITTER","https://twitter.com/AgeOfSurvival");

?> 

<!--Bannisement des ip non autorisé pour éviter des attaques par des robots

================================================== -->

<?php

 require("ip/ban_ip.php");

?> 

<?php
require('fonction_description_du_site.php');
    encodage_utf_8();
    declaration_meta($description_de_la_page,$mot_cle_de_la_page,$auteur_de_la_page);
     titre_de_la_page($titre);
    integration_css();
    code_javascript_google_analyse();
    javascript();
     fermeture_entete_obligatoire();

 ?>   

   

   <body>

<?php

require('fonction_entete.php');
   menu();
?>  

