<?php
//Cette page permet de modifier l'ordre des categories
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

include('config.php');

if(isset($_GET['id'], $_GET['action']) and ($_GET['action']=='up' or $_GET['action']=='down'))
{
$id = intval($_GET['id']);
$action = $_GET['action'];
$dn1 = mysql_fetch_array(mysql_query('select count(c.id) as nb1, c.position, count(c2.id) as nb2 from categories as c, categories as c2 where c.id="'.$id.'" group by c.id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['login']) and $_SESSION['login']==$admin)
{
	if($action=='up')
	{
		if($dn1['position']>1)
		{
			if(mysql_query('update categories as c, categories as c2 set c.position=c.position-1, c2.position=c2.position+1 where c.id="'.$id.'" and c2.position=c.position-1'))
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
						<div class="message">La catégorie a été changé de place.<br /><br />
							<a href="<?php echo $url_home; ?>" class="button">Retourner à l'index du Forum</a>
						</div>

					</div>
				</div>
			</div>	

				<?php
				}
			else
			{
				echo 'Une erreur s\'est produite lors du déplacement de la catégorie.';
			}
		}
		else
		{
			echo '<h2>L\'action que vous désirez effectuer est impossible.</h2>';
		}
	}
	else
	{
		if($dn1['position']<$dn1['nb2'])
		{
			if(mysql_query('update categories as c, categories as c2 set c.position=c.position+1, c2.position=c2.position-1 where c.id="'.$id.'" and c2.position=c.position+1'))
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
						<div class="message">La catégorie a été changé de place.<br /><br />
							<a href="<?php echo $url_home; ?>" class="button">Retourner à l'index du Forum</a>
						</div>

					</div>
				</div>
			</div>	
				<?php
				}
			else
			{
				echo 'Une erreur s\'est produite lors du déplacement de la catégorie.';
			}
		}
		else
		{
			echo '<h2>L\'action que vous désirez effectuer est impossible.</h2>';
		}
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
	echo '<h2>La catégorie que vous désirez déplacer n\'existe pas.</h2>';
}
}
else
{
	echo '<h2>L\'identifiant de la catégorie ou la direction du déplacement ne sont pas définis.</h2>';
}
?>