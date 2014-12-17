<?php
//Cette page permet d'ajouter un sujet
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

include('config.php');


if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
if(isset($_SESSION['login']))
{
	$dn1 = mysql_fetch_array(mysql_query('select count(c.id) as nb1, c.name from categories as c where c.id="'.$id.'"'));
if($dn1['nb1']>0)
{
?>
<script type="text/javascript" src="functions.js"></script>
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
    	<li><a href="list_topics.php?parent=<?php echo $id; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a></li> 
    	 <li> Nouveau Sujet </li>
   </ul>
	

<?php
if(isset($_POST['message'], $_POST['title']) and $_POST['message']!='' and $_POST['title']!='')
{
	include('bbcode_function.php');
	$title = $_POST['title'];
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$title = stripslashes($title);
		$message = stripslashes($message);
	}
	$title = mysql_real_escape_string($title);
	$message = mysql_real_escape_string(bbcode_to_html($message));
	if(mysql_query('insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$id.'", ifnull(max(id), 0)+1, "1", "'.$title.'", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics'))
	{
	?>
	<div class="message">Le sujet a bien &eacute;t&eacute; créé.<br /><br />
	<a href="list_topics.php?parent=<?php echo $id; ?>" class="button" >Retourner au forum</a></div>
	<?php
	}
	else
	{
		echo 'Une erreur s\'est produite lors de la création du sujet.';
	}
}
else
{
?>
<form action="new_topic.php?parent=<?php echo $id; ?>" method="post">
	<label for="title">Titre</label><input type="text" name="title" id="title"  /><br />
    <label for="message">Message</label><br />
    <div class="message_buttons">
        <input type="button" value="Gras" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italique" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Souligne" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Image" onclick="javascript:insert('[img]', '[/img]', 'message');" /><!--
        --><input type="button" value="Lien" onclick="javascript:insert('[url]', '[/url]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    <input type="submit" value="Envoyer" />
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
	echo '<h2>La catégorie dans laquelle vous désirez ajouter un sujet n\'existe pas.</h2>';
}
}
else
{
?>
<h2>Vous devez être connecté pour accéder à cette page:</h2>
<a href="../membres/connexion.php" class="button">Se connecter</a>
</div>
<?php
}
}
else
{
	echo '<h2>L\'identifiant dans laquelle vous désirez ajouter un sujet n\'est pas défini.</h2>';
}
?>