<?php
//Connexion bdd pour savoir nbre de news pour pagaination

$doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];
require($doc_root . "/connect/connect2.php");

$sql = "SELECT COUNT(id) as nombre_article FROM billets ";
$req = mysql_query($sql) or die(mysql_error());
$data = mysql_fetch_assoc($req);




$nombre_article = $data ['nombre_article']; //savoir le nombre d'article
$nombre_article_par_page = 3; // nombre d'article/page
$nombre_page = ceil($nombre_article / $nombre_article_par_page);

if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nombre_page) {
    $numero_page_courante = $_GET['p'];
} else {
    $numero_page_courante = 1;
}
?>



<?php
// Connexion bdd pour récupérer news en fonction de la pagination
$doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];
require($doc_root . "/connect/connect3.php");


$compteur = 0;
// On rÃ©cupÃ¨re tout le contenu de la table billets
$reponse = $bdd->query("SELECT * FROM billets ORDER BY id DESC LIMIT " . (($numero_page_courante - 1) * $nombre_article_par_page) . ",$nombre_article_par_page");

?>
<div class="pagination">
    <ul>


<?php
for ($i = 1; $i <= $nombre_page; $i++) {
    if ($i == $numero_page_courante) {
        echo "<li class=\"active\"><a href=\"#\">$i</a></li>";
    } else {
        echo "<li> <a href=\"index.php?p=$i\">$i</a></li> ";
    }
}
?> 
    </ul>
</div>     


        <?php
        // On affiche le derniÃ¨re entrer
        while ($donnees = $reponse->fetch()) {
            ?>
    
            <div class="page-header">
                <h1>
        <?php echo "{$donnees['titre']}"; ?> </h1>

              <i class="icon-calendar"></i> <?php echo "{$donnees['date_creation']}"; ?> | 
              <i class="icon-user"><a href="#"></i>  <?php echo"{$donnees['Auteur']}"; ?> </a> 
          
  </div>


                    <?php echo "{$donnees['contenu']}"; ?></p>


    <?php
}

$reponse->closeCursor(); // Termine le traitement de la requÃªte
?>









    <div class="pagination">
        <ul>


<?php
for ($i = 1; $i <= $nombre_page; $i++) {
    if ($i == $numero_page_courante) {
        echo "<li class=\"active\"><a href=\"#\">$i</a></li>";
    } else {
        echo "<li> <a href=\"index.php?p=$i\">$i</a></li> ";
    }
}
?> 

    </div>



</div>