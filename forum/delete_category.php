<?php
//Cette page permet de supprimer une catégorie
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

include('config.php');


if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysql_fetch_array(mysql_query('select count(id) as nb1, name, position from categories where id="'.$id.'" group by id'));
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
      	<li> Supprimer la catégorie</li>
    
    </ul> 
  
	

<?php
if(isset($_POST['confirm']))
{
	if(mysql_query('delete from categories where id="'.$id.'"') and mysql_query('delete from topics where parent="'.$id.'"') and mysql_query('update categories set position=position-1 where position>"'.$dn1['position'].'"'))
	{
	?>
	<div class="message">La catégorie et ses sujets a bien été supprimée.<br /><br />
	<a href="<?php echo $url_home; ?>" class="button">Retourner à l'index du Forum</a></div>
	<?php
	}
	else
	{
		echo 'Une erreur s\'est produite lors de la suppresssion de la catégorie et de ses sujets.';
	}
}
else
{
?>
<form action="delete_category.php?id=<?php echo $id; ?>" method="post">
	Êtes-vous sûr de vouloir supprimer cette catégorie et l'ensemble de ses sujets?
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
?>
<h2>Vous devez être connecté et être administrateur pour accéder à cette page:</h2>
 <a href="../membres/connexion.php" class="button">Se connecter</a>
<?php
}
}
else
{
	echo '<h2>La catégorie que vous désirez supprimer n\'existe pas.</h2>';
}
}
else
{
	echo '<h2>L\'identifiant de la catégorie à supprimer n\'est pas défini</h2>';
}
?>