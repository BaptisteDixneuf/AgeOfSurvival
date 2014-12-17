/*<------------------------->
     1- GESTION Monstre
     -Info:
        
       Déclarer un monstre à faiore sur server.js: Monstre_numero= new Monstre( numero, abscisse, ordonnee,maps_abscisse,map_ordonnee,nom)
       Ce fichier permet de gérer les attaques du client et de l'envoie quand il attaque 1 monstre.
       
    <-------------------------->*/

 /*MONSTRE[id]=new Array(8);
        MONSTRE[id][0]=id; 
        MONSTRE[id][1]=abscisse;
        MONSTRE[id][2]=ordonnee;
        MONSTRE[id][3]=map_abscisse;
        MONSTRE[id][4]=map_ordonnee;
        MONSTRE[id][5]=MONSTRE_CARACTERISTIQUES[type][1]; //vie  du monstre en fonction du type
        MONSTRE[id][6]=MONSTRE_CARACTERISTIQUES[type][4]; //nom  du monstre en fonction du type
        MONSTRE[id][7]=MONSTRE_CARACTERISTIQUES[type][2]; //qté de vie perdue en fonction du type
        MONSTRE[id][8]=MONSTRE_CARACTERISTIQUES[type][3]; // Image du monstre a apelle en fonction du type*/


var MONSTRE= [];



socket.on('monstre', function (data)
{
    console.log("monstre mis à jour");
MONSTRE=data;
}); 


// Détection de la touche controle dans gestion_deplacement.js
// La tocuhe controle apelle la fonction attaque de gestion_monstre.js,ci-dessous

function attaque()
{
         console.log("attaque");
    nbre_monstre=MONSTRE['nbre_monstre'];
    
    for (var i=0; i<nbre_monstre; i++)
    {
        
        vieMonstre=MONSTRE[i][5]+MONSTRE[i][7];
        
        if(vieMonstre<=0)
        {
            Jambon(); // Quand on tue un monstre on apelle la fonction Jambon de gestion_jambon.js
        }
    
    
           // Joueur en position case 2/9
            if(map_abscisse==MONSTRE[i][3] && map_ordonnee==MONSTRE[i][4] && abscisse==MONSTRE[i][1]  && ordonnee-1== MONSTRE[i][2]  && MONSTRE[i][5]>0 )
            {
                envoie_attaque(MONSTRE[i]);
               
                $('#affichageMessageAttaque').append( '<div class="message">' +  MONSTRE[i][6]+ ' perd : ' + MONSTRE[i][7] + ' points de vie . Il a désormais  '+ vieMonstre + ' points de vie. </div>' );
                $("#affichageMessageAttaque").animate({scrollTop: $("#affichageMessageAttaque")[0].scrollHeight},50);
            }
    
            // Joueur en position case 4/9
            if(map_abscisse==MONSTRE[i][3] && map_ordonnee==MONSTRE[i][4] && abscisse+1== MONSTRE[i][1]  && ordonnee== MONSTRE[i][2]  && MONSTRE[i][5]>0 )
            {
                envoie_attaque(MONSTRE[i]);
                $('#affichageMessageAttaque').append( '<div class="message">' +  MONSTRE[i][6]+ ' perd : ' + MONSTRE[i][7] + ' points de vie . Il a désormais  '+ vieMonstre + ' points de vie. </div>' );
                $("#affichageMessageAttaque").animate({scrollTop: $("#affichageMessageAttaque")[0].scrollHeight},50);
            
            }
            // Joueur en position case 6/9
            if(map_abscisse==MONSTRE[i][3] && map_ordonnee==MONSTRE[i][4] && abscisse-1== MONSTRE[i][1]  && ordonnee== MONSTRE[i][2] && MONSTRE[i][5]>0 )
            {
                envoie_attaque(MONSTRE[i]);
                $('#affichageMessageAttaque').append( '<div class="message">' +  MONSTRE[i][6]+ ' perd : ' + MONSTRE[i][7] + ' points de vie . Il a désormais  '+ vieMonstre + ' points de vie. </div>' );
                $("#affichageMessageAttaque").animate({scrollTop: $("#affichageMessageAttaque")[0].scrollHeight},50);
            }
            // Joueur en position case 8/9
            if(map_abscisse==MONSTRE[i][3] && map_ordonnee==MONSTRE[i][4] && abscisse== MONSTRE[i][1]  && ordonnee+1== MONSTRE[i][2]  && MONSTRE[i][5]>0 )
            {
                envoie_attaque(MONSTRE[i]);
                $('#affichageMessageAttaque').append( '<div class="message">' +  MONSTRE[i][6]+ ' perd : ' + MONSTRE[i][7] + ' points de vie . Il a désormais  '+ vieMonstre + ' points de vie. </div>' );
                $("#affichageMessageAttaque").animate({scrollTop: $("#affichageMessageAttaque")[0].scrollHeight},50);
            
             }
     
    }
}

// function utilisé par la fonction précédente pour envoyer la mise à jour du tableau Monstre sur le serveur
function envoie_attaque(monstre)
{
    console.log("Envoie attaque");
        socket.emit('envoie_attaque',{
        monstre:monstre,
		pseudo: pseudo,
     });
}  
 