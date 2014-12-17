<?php
//Cette page permet de supprimer un sujet
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

include('config.php');

if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['login']))
{
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
if($_SESSION['login']==$admin)
{
?>
<body>
<div  class="row">
  <div class="twelve columns">
     <div class="panel">
        <div class="page-header">

            <h1> Forums </h1>

            Informations capitales :)

        </div>

    	
    	<ul class="breadcrumbs">
        <li><a href="<?php echo $url_home; ?>">Index du Forum</a></li>
    	<li><a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> </li>
    	<li><a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a> </li>
    	<li> Supprimer le sujet<li>
    	</ul>
  
<?php
if(isset($_POST['confirm']))
{
	if(mysql_query('delete from topics where id="'.$id.'"'))
	{
	?>
	<div class="message">Le sujet a bien été supprimé.<br /><br />
	<a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>" class="button">Retourner au sujet</a></div>
	<?php
	}
	else
	{
		echo 'Une erreur s\'est produite lors de la suppression du sujet.';
	}
}
else
{
?>
<form action="delete_topic.php?id=<?php echo $id; ?>" method="post">
	Êtes-vous sûr de vouloir supprimer ce sujet?
    <input type="hidden" name="confirm" value="true" />
    <input type="submit" value="Oui" /> <input type="button" value="Non" onclick="javascript:history.go(-1);" />
</form>
<?php
}
?>
		</div>
		     </div>

    </div> 

  </div>  

</div>   



<!-- Pied de page

          ================================================== -->

          

          

               

<?php include("../include/pieddepage.php"); ?>    </div>    

</body>
</html>
<?php
}
else
{
	echo '<h2>Vous n\'avez pas le droit de supprimer ce sujet.</h2>';
}
}
else
{
	echo '<h2>Le sujet que vous désirez supprimer n\'existe pas.</h2>';
}
}
else
{
?>
<h2>Vous devez être connecté et être administrateur pour accéder à cette page:</h2>
 <a href="../membres/connexion.php" class="button">Se connecter</a>
<?php
}
}
else
{
	echo '<h2>Un identifiant du sujet que vous désirez supprimer n\'est pas défini.</h2>';
}
?>