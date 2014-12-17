<?php
//Cette page permet d'afficher la liste des sujets d'une categorie de forum
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

include('config.php');

if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
	$dn1 = mysql_fetch_array(mysql_query('select count(c.id) as nb1, c.name,count(t.id) as topics from categories as c left join topics as t on t.parent="'.$id.'" where c.id="'.$id.'" group by c.id'));
if($dn1['nb1']>0)
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
        <li><a href="list_topics.php?parent=<?php echo $id; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a></li>
    </ul>

<?php

if(isset($_SESSION['login']))
{
?>
	<a href="new_topic.php?parent=<?php echo $id; ?>" class="button">Nouveau Sujet</a>
    <br>
    <br>
    
<?php
}
$dn2 = mysql_query('select t.id, t.title, t.authorid, u.username as author, count(r.id) as replies from topics as t left join topics as r on r.parent="'.$id.'" and r.id=t.id and r.id2!=1  left join users as u on u.id=t.authorid where t.parent="'.$id.'" and t.id2=1 group by t.id order by t.timestamp2 desc');
if(mysql_num_rows($dn2)>0)
{
?>
<table class="twelve">
  <thead>
	<tr>
    	<th class="forum_tops">Sujet</th>
    	<th class="forum_auth">Auteur</th>
    	<th class="forum_nrep">Réponses</th>
<?php
if(isset($_SESSION['login']) and $_SESSION['login']==$admin)
{
?>
    	<th class="forum_act">Action</th>
<?php
}
?>
	</tr>
    <thead>
<?php
while($dnn2 = mysql_fetch_array($dn2))
{
?>
    <tbody>
	<tr>
    	<td class="forum_tops"><a href="read_topic.php?id=<?php echo $dnn2['id']; ?>"><?php echo htmlentities($dnn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo htmlentities($dnn2['author'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dnn2['replies']; ?></td>
<?php
if(isset($_SESSION['login']) and $_SESSION['login']==$admin)
{
?>
    	<td><a href="delete_topic.php?id=<?php echo $dnn2['id']; ?>"><img src="<?php echo $design; ?>/images/delete.png" alt="Delete" /></a></td>
<?php
}
?>
    </tr>

<?php
}
?>
</tbody>
</table>
<?php
}
else
{
?>
<div class="message">Cette catégorie ne contient aucun sujet.</div><br/><br/>
<?php
}
if(isset($_SESSION['login']))
{
?>
	<a href="new_topic.php?parent=<?php echo $id; ?>" class="button">Nouveau Sujet</a>
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