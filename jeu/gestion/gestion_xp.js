/*<------------------------->
     1- GESTION xp
     -On a accès à la varaible xp depuis  jeu.php en la récupérant depuis la bdd.
    <-------------------------->*/
   
   
    xp_max=1000;
    xp_poucentage=vie*100/xp_max;
     $('#xp').css('width', xp_poucentage+'%' );