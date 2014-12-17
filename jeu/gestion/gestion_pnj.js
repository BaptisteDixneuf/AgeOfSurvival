/*<------------------------->
     1- GESTION PNJ
    <-------------------------->*/
    
 // déclaration du tableau PNJ
 
  var PNJ=[];
 
 function Pnj(id,nom,abscisse,ordonnee,map_abscisse,map_ordonnee,sx,sy,sw,sh,image,message){
        
        PNJ[id]=new Array (11);
        PNJ[id][0]=id;
        PNJ[id][1]=nom;
        PNJ[id][2]=abscisse;
        PNJ[id][3]=ordonnee;
        PNJ[id][4]=map_abscisse;
        PNJ[id][5]=map_ordonnee;
        PNJ[id][6]=sx;
        PNJ[id][7]=sy;
        PNJ[id][8]=sw;
        PNJ[id][9]=sh;
        PNJ[id][10]=image;
        PNJ[id][11]=message;
        
    }
    
  

    //pnj_numero= new Arbre(id,nom,abscisse,ordonnee,map_abscisse,map_ordonnee,sx,sy,sw,sh,image,message)
    pnj_0 = new Pnj(0,"Dev 1",5,5,1,1,0,0,32,32,"pnj_1","Bonjour! Je fais parti de la Dev' team. Je me suis notamment occupé des interfaces et de la gestion des évènements!");
    pnj_1 = new Pnj(1,"Alf",5,5,1,2,0,0,82,61,"pnj_0","Bonjour! Bienvenue dans le jeu sur map 12");
    pnj_2 = new Pnj(2,"Dev 2",5,5,2,1,0,0,82,61,"pnj_0","Bonjour! Je fais parti de la Dev' team. Je me suis nottament occupé des graphismes du jeu. Quoi! C'est moche?!");
    pnj_3 = new Pnj(3,"Dev 3",5,5,2,2,0,0,82,61,"pnj_0","Bonjour! Je fais parti de la Dev' team. Je me suis nottament occupé des déplacements des personnages.");
    pnj_4 = new Pnj(4,"Le Comte Ivres",5,5,2,2,0,0,82,61,"pnj_0","Qu'ils sont biens ces petits jeunes de la Dev' team!");
	pnj_5 = new Pnj(5,"Boot'Ik",5,5,2,2,0,0,82,61,"pnj_0","Bonjour, je suis la fille de Jean Aidétruk. Je peux vous vendre beaucoup d'objets si vous avez de l'argent.");
    
    
 // Récupérer les coordonnées du joueur
 
  socket.on('coordonnee_utilisateur', function (data) {
                if(data.pseudo==pseudo){
                abscisse= data.abscisse;
                map_abscisse=data.map_abscisse;
                ordonnee= data.ordonnee;
				map_ordonnee= data.map_ordonnee;
                }


 
 // Les comprarés au coordonnées du joueurs pour afficher un message dans la tchatbox
 
    //console.log(PNJ.length);
    for(i=0; i<PNJ.length; i++) {
       // console.log("boucle pnj effectué");
        // Joueur en position case 1/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse+1== PNJ[i][2]  && ordonnee-1== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
        
        // Joueur en position case 2/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse==PNJ[i][2]  && ordonnee-1== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
        
        // Joueur en position case 3/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse-1== PNJ[i][2]  && ordonnee-1== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
    
        // Joueur en position case 4/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse+1== PNJ[i][2]  && ordonnee== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
        
        // Joueur en position case 5/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse== PNJ[i][2]  && ordonnee== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        } 
        
        // Joueur en position case 6/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse-1== PNJ[i][2]  && ordonnee== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
        
        // Joueur en position case 7/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse+1== PNJ[i][2]  && ordonnee+1== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
        
        // Joueur en position case 8/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse== PNJ[i][2]  && ordonnee+1== PNJ[i][3] )
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
        
        // Joueur en position case 9/9
        if(map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5] && abscisse-1== PNJ[i][1]  && ordonnee+1== PNJ[i][3])
        {
            $('#affichageMessagePNJ').append( '<div class="message">' + PNJ[i][1] + ' : '+ PNJ[i][11] + '</div>' );
            $("#affichageMessagePNJ").animate({scrollTop: $("#affichageMessagePNJ")[0].scrollHeight},50);
        }
        
            
    }
});
 
    