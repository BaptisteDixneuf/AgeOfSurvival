<?php
//Cette page permet de modifier une categorie
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

include('config.php');

if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysql_fetch_array(mysql_query('select count(id) as nb1, name, description from categories where id="'.$id.'" group by id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['login']) and $_SESSION['login']==$admin)
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
    	<li><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> </li>
    	<li> Modifier la catégorie</li>
    </ul>
    
<?php
if(isset($_POST['name'], $_POST['description']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	if(get_magic_quotes_gpc())
	{
		$name = stripslashes($name);
		$description = stripslashes($description);
	}
	$name = mysql_real_escape_string($name);
	$description = mysql_real_escape_string($description);
	if(mysql_query('update categories set name="'.$name.'", description="'.$description.'" where id="'.$id.'"'))
	{
	?>
	<div class="message">La catégorie a bien été modifiée.<br /><br />
	<a href="<?php echo $url_home; ?>" class="button">Retourner à l'index du Forum</a></div>
	<?php
	}
	else
	{
		echo 'Une erreur s\'est produite lors de la modification de la catégorie.';
	}
}
else
{
?>
<form action="edit_category.php?id=<?php echo $id; ?>" method="post">
	<label for="name">Nom</label><input type="text" name="name" id="name" value="<?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>" /><br />
	<label for="description">Description</label>(html accepté)<br />
    <textarea name="description" id="description" cols="70" rows="6"><?php echo htmlentities($dn1['description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br />
    <input type="submit" value="Modifier" />
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
?>
<h2>Vous devez être connecté et être administrateur pour accéder à cette page:</h2>
 <a href="../membres/connexion.php" class="button">Se connecter</a>
<?php
}
}
else
{
	echo '<h2>La catégorie que vous désirez modifier n\'existe pas.</h2>';
}
}
else
{
	echo '<h2>L\'identifiant de la catégorie à modifier n\'est pas défini</h2>';
}
?>