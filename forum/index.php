<?php
//Cette page permet dafficher la liste des categories

$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

include('config.php');


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
    </ul>
 
<?php
if(isset($_SESSION['login']) and $_SESSION['login']==$admin)
{
?>
	<a href="new_category.php" class="button">Nouvelle Catégorie</a>
    <br>
    <br>
<?php
}
?>
<table class="twelve">
  <thead>
	<tr>
    	<th class="forum_cat">Catégorie</th>
    	<th class="forum_ntop">Sujets</th>
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
    </thead>
<?php
$dn1 = mysql_query('select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
$nb_cats = mysql_num_rows($dn1);
while($dnn1 = mysql_fetch_array($dn1))
{
?>
    <tbody>
	<tr>
    	<td class="forum_cat"><a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <div class="description"><?php echo $dnn1['description']; ?></div></td>
    	<td><?php echo $dnn1['topics']; ?></td>
    	<td><?php echo $dnn1['replies']; ?></td>
<?php
if(isset($_SESSION['login']) and $_SESSION['login']==$admin)
{
?>
    	<td><a href="delete_category.php?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/delete.png" alt="Delete" /></a>
		<?php if($dnn1['position']>1){ ?><a href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/up.png" alt="Faire Monter" /></a><?php } ?>
		<?php if($dnn1['position']<$nb_cats){ ?><a href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/down.png" alt="Faire Descendre" /></a><?php } ?>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/edit.png" alt="Edit" /></a></td>
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
if(isset($_SESSION['login']) and $_SESSION['login']==$admin)
{
?>
	<a href="new_category.php" class="button">Nouvelle Catégorie</a>
<?php
}
if(!isset($_SESSION['login']))
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