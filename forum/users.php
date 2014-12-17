<?php
//Cette page affiche la liste des utilisateurs inscrits
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
    	       <li> Liste des utilisateurs</li>
            </ul>
    
<?php

?>
Voici la liste des utilisateurs:<br/><br/>
<table class="twelve">
  <thead>
    <tr>
    	<th>Id</th>
    	<th>Nom d'utilisateur</th>
    	<th>Email</th>
    </tr>
</thead>
<?php
//On recupere les identifiants, les pseudos et les emails des utilisateurs
$req = mysql_query('select id, username, email from users');
while($dnn = mysql_fetch_array($req))
{
?>
<tbody>
	<tr>
    	<td><?php echo $dnn['id']; ?></td>
    	<td><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
</tbody>
<?php
}
?>
</table>
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