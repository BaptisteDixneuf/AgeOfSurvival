<?php 
$description_de_la_page= "Profil - Age of Survival";
$mot_cle_de_la_page="profil,avatar"; 
$auteur_de_la_page="Dixneuf Baptiste";
$titre= "Profil - Age of Survival";
?>
<?php include("../include/entete.php"); ?>
<div  class="row">
    <div class="seven columns">
        <div class="panel">
            <div class="page-header">
                <h1>  
                    Profil 
                 </h1>
                <i class="icon-user icon-black">
                </i>
                 Avatar, pseudo, ...

            </div>
<?php
if ($_SESSION['activation'] != "oui"){
echo "<button class=\"alert radius button\" >" ;
echo "Erreur : Vous n'êtes pas connecté. Cette page est interdite";  
echo "</button>";
echo "</br></br>";
}
else
{ 
?>
    <strong>Pseudo: </strong>           
        <?php
            echo htmlentities(trim($_SESSION['login']));
        ?>
    </br>
    </br>
   <strong> Mot de passe:</strong>
              
        <?php
            echo htmlentities(trim($_SESSION['mot_de_passe']));
         
}
    ?>
    
<?php 
// La session est démarré gâce à l'include au dessus
// On associe les sessions à des variables plus simple à manipuler

    $pseudo=$_SESSION['login'];
    $mot_de_passe=$_SESSION['mot_de_passe'];

    // On vérifie que la session est bien active pour effectuer ensuite une connexion autrement on le redirige vers la page de connexion

    if ($_SESSION['activation'] != "oui"){
        ?>
    <script> 
        window.location='http://ageofsurvival.koding.com/membres/connexion.php';
    </script> 
        
       <?php
        }
   // On récupère les infos du joueur  dans une basse de donnée 
    require "../connect/connect2.php";   
    $sql='SELECT * FROM deplacement WHERE pseudo= \'' . $pseudo . '\' ';
    $req= mysql_query($sql) or die (mysql_error());
        $data = mysql_fetch_array($req);
		$d["erreur"]="ok";
		$map_abscisse=$data['map_abscisse'];
        $map_ordonnee=$data['map_ordonnee'];
		$abscisse=$data['abscisse'];
		$ordonnee=$data['ordonnee'];
?>
<?php
        
   // On récupère les infos du joueur pour son inventaire  dans une basse de donnée 
    require "../connect/connect2.php";   
    $sql2='SELECT * FROM inventaire WHERE pseudo= \'' . $pseudo . '\' ';
    $req2= mysql_query($sql2) or die (mysql_error());
        $data2 = mysql_fetch_array($req2);
		$d["erreur"]="ok";
		$epee=$data2['epee'];
        $jambon=$data2['jambon'];
		$vie=$data2['vie'];
		$xp=$data2['xp'];
        $pomme=$data2['pomme'];
?>   
   </br>
   </br>
 <strong>Votre position:</strong>
 </br>
 </br>
   <table class="twelve">
  <thead>
    <tr>
      <th>Map Abscisse</th>
      <th>Map Ordonnée</th>
      <th>Abscisse</th>
      <th>Ordonnée</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $map_abscisse ?></td>
      <td><?php echo $map_ordonnee ?></td>
      <td><?php echo $abscisse ?></td>
      <td><?php echo $ordonnee ?></td>
    </tr>
    </tbody>
</table>

<strong>Inventaire:</strong>
 </br>
 </br>
   <table class="twelve">
  <thead>
    <tr>
      <th>Epée</th>
      <th>Jambon</th>
      <th>Vie</th>
      <th>Xp</th>
      <th>pomme</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $epee ?></td>
      <td><?php echo $jambon ?></td>
      <td><?php echo $vie ?></td>
      <td><?php echo $xp ?></td>
      <td><?php echo $pomme ?></td>
    </tr>
    </tbody>
</table>
</div>
</div> 
</div>  
</div>   
<!-- Pied de page
================================================== -->
<?php include("../include/pieddepage.php"); ?> 
</div>    
</body>
</html>
