/*<------------------------->
     1- GESTION POMME
     -Info:
        -on récupère dans jeu.php la variable pomme automatiquement de la bdd à chaque connexion
        -On enregsitre tous les 20 secondes la variable pomme dans la bdd grâce au fichier enregistrement_donnee.php
    <-------------------------->*/
    
    
      var pomme; 
      var pourcentage_drop_pomme=10;
      var nbre_max_pomme=50;
    
          
    // déclaratiopn des PNJ
     var ARBRE=[];
     
    function Arbre (id,abscisse,ordonnee,map_abscisse,map_ordonnee){
        
        ARBRE[id]=new Array (4);
        ARBRE[id][0]=abscisse;
        ARBRE[id][1]=ordonnee;
        ARBRE[id][2]=map_abscisse;
        ARBRE[id][3]=map_ordonnee;
            
    }
    
  

    //arbre_numero= new Arbre( numero, abscisse, ordonnee,maps_abscisse,map_ordonnee)
    arbre_0 = new Arbre(0,24,1,1,1);
    arbre_1 = new Arbre(1,24,2,1,1);
    arbre_2 = new Arbre(2,25,1,1,1);
    arbre_3 = new Arbre(3,25,2,1,1);
    arbre_4 = new Arbre(4,26,1,1,1);
    arbre_5 = new Arbre(5,26,2,1,1);
    
    
    
    
    $("#compteur_pommes").replaceWith( '<div id="compteur_pommes">' +pomme +'/'+nbre_max_pomme +'</div>' );
 
 
 //Ajouter des pommes à l'inventaire
    
    socket.on('coordonnee_utilisateur', function (data)
    {
         if(data.pseudo==pseudo)
            {
                abscisse= data.abscisse;
                map_abscisse=data.map_abscisse;
                ordonnee= data.ordonnee;
                map_ordonnee= data.map_ordonnee;
            }
                
         for(i=0; i<ARBRE.length; i++)             
        {
            if(pomme<nbre_max_pomme)
            { 
               if(map_abscisse==ARBRE[i][2] && map_ordonnee==ARBRE[i][3] && abscisse== ARBRE[i][0]  && ordonnee== ARBRE[i][1] )
               {
                    var nb_aleatoire = Math.floor(Math.random() * 101); 
             
                    /* Maths.random=> nombre entre o et 1 non inclus et 
                    Math.floor => floor() retourne le plus grand entier inférieur ou égal à la valeur donnée en paramètre*/
               
                        if(nb_aleatoire < pourcentage_drop_pomme )
                        {
                            pomme++;
                          } 
                        else{
                             pomme=pomme;
                        }  
                } 
                else{
                pomme=pomme;
                }
                 
            }
            else{
                pomme=pomme;
            }
        
        }
         
    
            $("#compteur_pommes").replaceWith( '<div id="compteur_pommes">' +pomme +'/50 </div>' );
          
    }); 
    
    
    