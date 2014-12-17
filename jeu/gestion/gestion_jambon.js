/*<------------------------->
     1- GESTION JAMBON
     -Info:
        -on récupère dans jeu.php la variable jambon automatiquement de la bdd à chaque connexion
        -On enregsitre tous les 20 secondes la variable jambon dans la bdd grâce au fichier enregistrement_donnee.php
    <-------------------------->*/
    

  jambon=parseInt(jambon,10);
  function Jambon()
  {
    console.log("fonction jambon appellé");
    console.log(jambon);
    jambon=parseInt(jambon,10)+1;

    $("#compteur_viande").replaceWith( '<div id="compteur_viande">' + jambon +'/50 </div>' );

  }
  
  
  $("#compteur_viande").replaceWith( '<div id="compteur_viande">' + jambon +'/50 </div>' );




 