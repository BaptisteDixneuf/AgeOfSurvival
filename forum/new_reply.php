<?php
//Cette page permet de répondre à un sujet
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
      	<li><a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8') ?></a> </li>
    	<li><a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8') ?></a></li>
    	<li>Ajout d'une réponse</li>
    
    </ul>
    	

<?php
if(isset($_POST['message']) and $_POST['message']!='')
{
	include('bbcode_function.php');
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysql_real_escape_string(bbcode_to_html($message));
	if(mysql_query('insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$dn1['parent'].'", "'.$id.'", max(id2)+1, "", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics where id="'.$id.'"') and mysql_query('update topics set timestamp2="'.time().'" where id="'.$id.'" and id2=1'))
	{
	?>
	<div class="message">Le message a bien &eacute;t&eacute; envoy&eacute;.<br /><br />
	<a href="read_topic.php?id=<?php echo $id; ?>" class="button">Retourner au sujet</a></div>
	<?php
	}
	else
	{
		echo 'Une erreur s\'est produite lors de l\'envoi du message.';
	}
}
else
{
?>
<form action="new_reply.php?id=<?php echo $id; ?>" method="post">
   <label for="message"><h2>Message</h2></label><br />
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
	echo '<h2>Le sujet auquel vous désirez répondre n\'existe pas.</h2>';
}
}
else
{
?>
<h2>Vous devez être connecté pour accéder à cette page:</h2>
 <a href="../membres/connexion.php" class="button">Se connecter</a>
<?php
}
}
else
{
	echo '<h2>L\'identifiant du sujet auquel vous désirez répondre n\'est pas défini.</h2>';
}
?>