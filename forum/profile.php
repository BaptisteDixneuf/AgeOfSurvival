<?php
//Cette page permet d'afficher le profil d'un membre
$description_de_la_page = "Age of Survival";
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
                <li><a href="<?php echo $url_home; ?>">Index du Forum</a> </li>
                <li><a href="users.php">Liste des utilisateurs</a></li>
                <li> Profil d'un utilisateur</li>
            </ul>
	


<?php

if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn = mysql_query('select username, email, signup_date from users where id="'.$id.'"');
	if(mysql_num_rows($dn)>0)
	{
		$dnn = mysql_fetch_array($dn);
?>


<h1><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
    	Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br />
        Cet utilisateur s'est inscrit le <?php echo date('d/m/Y',$dnn['signup_date']); ?></td>

<?php

	}
	else
	{
		echo 'Cet utilisateur n\'existe pas.';
	}
}
else
{
	echo 'L\'identifiant de l\'utilisateur n\'est pas d&eacute;fini.';
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