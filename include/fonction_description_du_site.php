<?php 

function encodage_utf_8(){

?>

<head>

<!--Encodage

================================================== -->

<meta charset="utf-8">



<?php
  }
?>


<?php 
function declaration_meta($description_de_la_page,$mot_cle_de_la_page,$auteur_de_la_page){
?>

<!--Déclaration des méta-données
================================================== -->

<meta name="description" content="<?php echo $description_de_la_page ?>" />

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<meta name="keywords" content="<?php echo $mot_cle_de_la_page ?>" />

<meta name="author" content="<?php echo $auteur_de_la_page ?>" />

<meta name="copyright" content="Age of Survival" />

<?php
  }
?>    



<?php 
function titre_de_la_page($titre){
?>
<!--Titre de la page et icone du site
================================================== -->

<title><?php echo $titre;?> </title>

<link rel="shortcut icon" href="<?php echo URLRACINE; ?>images/emblem.png" width="100%" height="100%"> <!-- Icone dans le navigateur dans l'onglet !-->

<?php
  }
?>

	

<?php 

function integration_css(){

?>

<!--Intégration du css pour ordinateur
================================================== -->

  <link rel="stylesheet" href="<?php echo URLRACINE; ?>foundation/stylesheets/foundation.css">
 

  <script src="<?php echo URLRACINE; ?>foundation/javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

<?php
  }
?>



<?php 
function code_javascript_google_analyse(){
?>
<!--Code javascript pour google analytics
================================================== -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38389615-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


<?php
  }
?>  






<?php 

function javascript(){

?>

<!--  Intégration des fichiers pour le javascript

================================================== -->

<!--script javascript a activé si on utilise le js de foundation: le framework css -->
  <!--
  <script src="foundation/javascripts/jquery.js"></script>
  
  <script src="foundation/javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="foundation/javascripts/jquery.foundation.forms.js"></script>
  -->
  <script src="<?php echo URLRACINE; ?>foundation/javascripts/jquery.foundation.reveal.js"></script>
    <!--
  <script src="foundation/javascripts/jquery.foundation.orbit.js"></script>
  
  <script src="foundation/javascripts/jquery.foundation.navigation.js"></script>
  
  <script src=""foundation/javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="foundation/javascripts/jquery.foundation.tabs.js"></script>
   

  <script src="foundation/javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="foundation/javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="foundation/avascripts/jquery.placeholder.js"></script>
  
  <script src="foundation/javascripts/jquery.foundation.alerts.js"></script>
  
  <script src="foundation/javascripts/jquery.foundation.topbar.js"></script>
   -->
 
  
  <!-- Included JS Files (Compressed) -->
  <script src="<?php echo URLRACINE; ?>foundation/javascripts/jquery.js"></script>
 <script src="<?php echo URLRACINE; ?>foundation/javascripts/foundation.min.js"></script>
  
  <!--Initialize JS Plugins -->
  <script src="<?php echo URLRACINE; ?>foundation/javascripts/app.js"></script>

<?php
  }
?>

<?php 
function fermeture_entete_obligatoire(){
?>
</head>
<?php
    }
?> 