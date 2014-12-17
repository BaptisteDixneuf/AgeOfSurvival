/*<------------------------->
     1- GESTION VIE
     -On a accès à la varaible vie depuis vie jeu.php en la récupérant depuis la bdd.
    <-------------------------->*/
   
   console.log('vie au début' +vie);
    vie_max=1000;
    vie_poucentage=parseInt(vie,10)*100/vie_max;
     $('#vie').css('width', vie_poucentage+'%' );
    recuperation_vie_jambon=100;
    recuperation_vie_pomme=50;
    perteviesurtemps=-10;

    //Gagner de la vie avec le jambon
    
    function Affichage_vie(fluctation)
    {
        vie=parseInt(vie,10)+fluctation;
        vie_poucentage=parseInt(vie,10)*100/vie_max;
        $('#vie').css('width', vie_poucentage+'%' );
            
    }


    // Déclencher quand on clique sur le jambon avec la soruis ( voir fichier jeu.php au niveau des jambons  )
    function Vie() 
    {
         if((parseInt(vie,10) +recuperation_vie_jambon) <=vie_max)
         {
            jambon=parseInt(jambon,10);
            jambon=parseInt(jambon,10)-1;
            $("#compteur_viande").replaceWith( '<div id="compteur_viande">' + jambon +'/50 </div>' );
           /* vie=parseInt(vie,10)+100;
            vie_poucentage=parseInt(vie,10)*100/vie_max;
            $('#vie').css('width', vie_poucentage+'%' );*/
            Affichage_vie(recuperation_vie_jambon);
         }
         else
         {
             alert("Vous avez atteind le max de vie: "+ vie);
         }
    }
    
        // Déclencher quand on clique sur la pomme avec la soruis ( voir fichier jeu.php au niveau des jambons  )
    function Vie2() 
    {
         if((parseInt(vie,10) +recuperation_vie_pomme) <=vie_max)
         {
            pomme=parseInt(pomme,10);
            pomme=parseInt(pomme,10)-1;
            $("#compteur_pommes").replaceWith( '<div id="compteur_pommes">' + pomme +'/50 </div>' );
           /* vie=parseInt(vie,10)+100;
            vie_poucentage=parseInt(vie,10)*100/vie_max;
            $('#vie').css('width', vie_poucentage+'%' );*/
            Affichage_vie(recuperation_vie_pomme);
         }
         else
         {
             alert("Vous avez atteind le max de vie: "+ vie);
         }
    }
    
    setInterval(function() {
           Affichage_vie(-10);
      },30000);
    
    



   