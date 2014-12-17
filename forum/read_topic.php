<?php
//Cette page permet d'afficher le contenu d'un sujet
    $description_de_la_page = "Age of Survival google";
    $mot_cle_de_la_page = "Age of Survival";
    $auteur_de_la_page = "Dixneuf Baptiste";
    $titre = "Age of Survival";

    require("../include/entete.php");

include('config.php');

if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.title, t.parent, count(t2.id) as nb2, c.name from topics as t, topics as t2, categories as c where t.id="'.$id.'" and t.id2=1 and t2.id="'.$id.'" and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{


?>

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
        <li> Lecture des messages</li>
    </ul>

<?php

?>
<h1><?php echo $dn1['title']; ?></h1>
<br/>



<?php
if(isset($_SESSION['login']))
{
?>

		<a href="new_reply.php?id=<?php echo $id; ?>" class="button">Répondre</a>
		<br/>
		<br/>
<?php
}
	$dn2 = mysql_query('select t.id2, t.authorid, t.message, t.timestamp, u.username as author from topics as t, users as u where t.id="'.$id.'" and u.id=t.authorid order by t.timestamp asc');
?>
	<table class="twelve">
	  <thead>
			<tr>
			   <th class="author">Auteur</th>
			   <th>Message</th>
		   </tr>
		</thead>
		<?php
		while($dnn2 = mysql_fetch_array($dn2))
		{
		?>
			<tbody>
			   <tr>
				   <td ><br /><a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo $dnn2['author']; ?></a></td>
				   <td >
				   
				   <?php 
				   $_SESSION['login']=mb_strtolower($_SESSION['login']);
                   $dnn2['author']=mb_strtolower($dnn2['author']);
				   if(isset($_SESSION['login']) and ($_SESSION['login']==$dnn2['author'] or $_SESSION['login']==$admin))
						{ 
						?>
						<div class="edit">
						<a href="edit_message.php?id=<?php echo $id; ?>&id2=<?php echo $dnn2['id2']; ?>">
							<img src="<?php echo $design; ?>/images/edit.png" alt="Modifier" />
						</a>
						</div><?php } ?>
						<div class="date">Date d'envoi: <?php echo date('d/m/Y H:i:s' ,$dnn2['timestamp']); ?>
						</div>
				   
				   <?php echo $dnn2['message']; ?></td>
				</tr>
			<tbody>
		<?php
		}
	?>
	</table>
	<?php
	
	if(isset($_SESSION['login']))
	{
	?>
		<a href="new_reply.php?id=<?php echo $id; ?>" class="button">Répondre</a>
	<?php
	}
	else
	{
	?>
	<a href="../membres/connexion.php" class="button">Se connecter</a>
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
		echo '<h2>La catégorie que vous désirez visiter n\'existe pas.</h2>';
	}
}
else
{
	echo '<h2>L\'identifiant de la catégorie que vous désirez visiter n\'est pas défini.</h2>';
}
?>