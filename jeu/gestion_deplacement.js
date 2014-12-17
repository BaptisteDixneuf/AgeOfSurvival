
/*<------------------------->
    2- GESTION DES DEPLACEMENTS
    <-------------------------->*/    

    
    //1- On envoie des coordonnees initiales pour initialiser le joueur sur la carte
      socket.emit('envoie_coordonnee_utilisateur_initial',{
                pseudo: pseudo,
                map_abscisse: map_abscisse,
                map_ordonnee: map_ordonnee,
                abscisse: abscisse,
                ordonnee: ordonnee,
        });

	 
    
    //2- Dection des deplacements


          function controle_clavier() {
            // Gestion du clavier
            var blocage = 1;
            window.onkeydown = function(event){
                if (blocage)
                {
                // On reupee le code de la touche
                var e = event || window.event;
                var key = e.which || e.keyCode;
                }
                switch(key) {
                    case 17 :  // touche control
                        attaque();
                        break;
                    case 38 :  // Fleche haut
                        blocage = 0;
                        deplacements("haut",abscisse,ordonnee);
                        setTimeout( function() {blocage = 1;}, 620);
                        break;
                    case 40 :// Fleche bas
                        blocage = 0;
                        deplacements("bas",abscisse,ordonnee);
                        setTimeout( function() {blocage = 1;}, 620);
                        break;
                    case 37 :  // Fleche gauche
                        blocage = 0;
                        deplacements("gauche",abscisse,ordonnee);
                        setTimeout( function() {blocage = 1;}, 620);
                        break;
                    case 39 : // Fleche droite
                        blocage = 0;
                        deplacements("droite",abscisse,ordonnee);
                        setTimeout( function() {blocage = 1;}, 620);
                        break;
                    default : 
                        // Si la touche ne nous sert pas, nous n'avons aucune raison de bloquer son comportement normal.
                        return true;
                }
                return false;
            };
        }

        var largeur_map = 33;
        var hauteur_map = 17;
        var x_map_abscisse = 2;
        var y_map_ordonnee = 2;
        var joueurs = new Array();
        var z = -1;
        var tileinterdit = new Array (7,16,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,61,62,63,66,67,68,72);

    function deplacements(direction,abscisse,ordonnee){
        var a=1; // Se deplace de n en n case
		// parseInt(a) equivaut a dire 1
        
        var position = "00";
        if (position != (String(map_abscisse) + String(map_ordonnee))) {
            //récupération de la map
                // Création de l'objet XmlHttpRequest
                var xhr2 = getXMLHttpRequest();
                position = String(map_abscisse) + String(map_ordonnee);
		
                // Chargement du fichier
                xhr2.open("GET", './maps/' + position + '.json', false);
                xhr2.send(null);
                if(xhr2.readyState != 4 || (xhr2.status != 200 && xhr2.status !== 0)) // Code == 0 en local
                    throw new Error("Impossible de charger la carte nommée \"" + position + "\" (code HTTP : " + xhr2.status + ").");
                var mapJsonData = xhr2.responseText;
	
                // Analyse des données
                var mapData = JSON.parse(mapJsonData);
                var tileset = new Tileset(mapData.tileset);
                var terrain = mapData.terrain;
        }


        if(direction=="haut"){
            abscisse= abscisse;
            map_ordonnee = parseInt(map_ordonnee,10);
			map_abscisse = parseInt(map_abscisse,10);
            ordonnee= parseInt(ordonnee,10) + parseInt(a,10);
            
            //calcul pour vérifier que la destination existe
			if (parseInt(ordonnee,10) > parseInt(hauteur_map,10))
				{
				if (parseInt(map_ordonnee,10) == parseInt(y_map_ordonnee,10))
					{
					ordonnee = parseInt(ordonnee,10) - parseInt(a,10);
                    return;
					}
				else
					{
					map_ordonnee = parseInt(map_ordonnee,10) + parseInt(a,10);
					ordonnee = parseInt(a,10);
					}
				}
                
            //vérification du fait qu'il n'y ai pas de joueur sur la destination
            for(var i=0; i<=z;i++) {
                if (abscisse==joueurs[i][3][0] && ordonnee==joueurs[i][3][1] && map_abscisse==joueurs[i][3][2] && map_ordonnee==joueurs[i][3][3] && joueurs[i][1]!=pseudo) {
                    ordonnee = parseInt(ordonnee,10) - parseInt(a,10);
                    if (ordonnee ==  (parseInt(a,10)-parseInt(a,10))) {
                        ordonne = parseInt(hauteur_map,10);
                        map_ordonnee = parseInt(map_ordonnee,10) - parseInt(a,10);
                    }
                    return;
                }
            }
            
            //vérification si il n'y a pas de PNJ sur la destination
            for(var i=0; i<PNJ.length;i++) {
                if (abscisse==PNJ[i][2] && ordonnee==PNJ[i][3] && map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5]) {
                    ordonnee = parseInt(ordonnee,10) - parseInt(a,10);
                    if (ordonnee ==  (parseInt(a,10) - parseInt(a,10))) {
                        ordonne = parseInt(hauteur_map,10);
                        map_ordonnee = parseInt(map_ordonnee,10) - parseInt(a,10);
                    }
                    return;
                }
            }
            
            //vérification si le tiles est autorisé
            console.log("terrain"+terrain);
            if(terrain){
                var ligne = terrain[(17-ordonnee)];
                var numerodutile = ligne[(abscisse-1)];
                for (var i=0; i<tileinterdit.length; i++) {
                    if (numerodutile==tileinterdit[i]) {
                        console.log("déplacement bloqué");
                        ordonnee = parseInt(ordonnee,10) - parseInt(a,10);
                        if (ordonnee ==  (parseInt(a,10) - parseInt(a,10))) {
                            ordonne = parseInt(hauteur_map,10);
                            map_ordonnee = parseInt(map_ordonnee,10) - parseInt(a,10);
                        }
                        return;
                    }
                }
            }
            
            //si tout est bon envoi
			envoyerDeplacement(abscisse,map_abscisse,ordonnee,map_ordonnee,pseudo);
            deplacement(abscisse, ordonnee, "haut", map_abscisse, map_ordonnee);
        }

        if(direction=="bas"){
            abscisse= parseInt(abscisse,10);
            map_ordonnee = parseInt(map_ordonnee,10);
			map_abscisse = parseInt(map_abscisse,10);
            ordonnee= parseInt(ordonnee,10)-parseInt(a,10);
            
            //calcul pour vérifier que la destination existe
			if (parseInt(ordonnee,10) < parseInt(a,10))
				{
				if (parseInt(map_ordonnee,10) == parseInt(a,10))
					{
					ordonnee = parseInt(ordonnee,10) + parseInt(a,10);
                    return;
					}
				else
					{
					map_ordonnee = parseInt(map_ordonnee,10) - parseInt(a,10);
					ordonnee = parseInt(hauteur_map,10);
					}
				}
                
            //vérification du fait qu'il n'y ai pas de joueur sur la destination
            for(var i=0; i<=z;i++) {
                if (abscisse==joueurs[i][3][0] && ordonnee==joueurs[i][3][1] && map_abscisse==joueurs[i][3][2] && map_ordonnee==joueurs[i][3][3] && joueurs[i][1]!=pseudo) {
                    ordonnee = parseInt(ordonnee,10) + parseInt(a,10);
                    if (ordonnee ==  (parseInt(hauteur_map,10)+parseInt(a,10))) {
                        ordonne = parseInt(a,10);
                        map_ordonnee = parseInt(map_ordonnee,10) + parseInt(a,10);
                    }
                return;
                }
            }
                
            //vérification si il n'y a pas de PNJ sur la destination
            for(var i=0; i<PNJ.length;i++) {
                if (abscisse==PNJ[i][2] && ordonnee==PNJ[i][3] && map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5]) {
                    ordonnee = parseInt(ordonnee,10) + parseInt(a,10);
                    if (ordonnee ==  (parseInt(hauteur_map,10)+parseInt(a,10))) {
                        ordonne = parseInt(a,10);
                        map_ordonnee = parseInt(map_ordonnee,10) + parseInt(a,10);
                    }
                    return;
                }
            }
                
            //vérification si le tiles est autorisé
            console.log("terrain"+terrain);
            if(terrain){
                var ligne = terrain[(17-ordonnee)];
                var numerodutile = ligne[(abscisse-1)];
                for (var i=0; i<tileinterdit.length; i++) {
                    if (numerodutile==tileinterdit[i]) {
                        console.log("déplacement bloqué");
                        ordonnee = parseInt(ordonnee,10) + parseInt(a,10);
                        if (ordonnee ==  (parseInt(hauteur_map,10)+parseInt(a,10))) {
                            ordonne = parseInt(a,10);
                            map_ordonnee = parseInt(map_ordonnee,10) + parseInt(a,10);
                        }
                    return;
                    }
                }
            }
            
            //si tout est bon envoi
            envoyerDeplacement(abscisse,map_abscisse,ordonnee,map_ordonnee,pseudo);
            deplacement(abscisse, ordonnee, "bas", map_abscisse, map_ordonnee);
        }
    
    
        if(direction=="gauche"){
            abscisse= parseInt(abscisse,10)-parseInt(a,10);
            map_ordonnee = parseInt(map_ordonnee,10);
            map_abscisse = parseInt(map_abscisse,10);
            ordonnee= parseInt(ordonnee,10);
            
            //calcul pour vérifier que la destination existe
			if (parseInt(abscisse,10) < parseInt(a,10))
				{
				if (parseInt(map_abscisse,10) == parseInt(a,10))
					{
					abscisse = parseInt(abscisse,10) + parseInt(a,10);
                    return;
					}
                else
					{
					map_abscisse = parseInt(map_abscisse,10) - parseInt(a,10);
					abscisse = parseInt(largeur_map,10);
					}
				}
                
            //vérification du fait qu'il n'y ai pas de joueur sur la destination
            for(var i=0; i<=z;i++) {
                if (abscisse==joueurs[i][3][0] && ordonnee==joueurs[i][3][1] && map_abscisse==joueurs[i][3][2] && map_ordonnee==joueurs[i][3][3] && joueurs[i][1]!=pseudo) {
                    abscisse = parseInt(abscisse,10) + parseInt(a,10);
                    if (abscisse ==  (parseInt(a,10)-parseInt(a,10))) {
                        abscisse = parseInt(a,10);
                        map_abscisse = parseInt(map_abscisse,10) + parseInt(a,10);
                    }
                    return;
                }
            }
                
            //vérification si il n'y a pas de PNJ sur la destination
            for(var i=0; i<PNJ.length;i++) {
                if (abscisse==PNJ[i][2] && ordonnee==PNJ[i][3] && map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5]) {
                    abscisse = parseInt(abscisse,10) + parseInt(a,10);
                    if (abscisse ==  (parseInt(a,10)-parseInt(a,10))) {
                        abscisse = parseInt(a,10);
                        map_abscisse = parseInt(map_abscisse,10) + parseInt(a,10);
                    }
                    return;
                }
            }
                
            //vérification si le tiles est autorisé
            console.log("terrain"+terrain);
            if(terrain){
                var ligne = terrain[(17-ordonnee)];
                var numerodutile = ligne[(abscisse-1)];
                    for (var i=0; i<tileinterdit.length; i++) {
                    if (numerodutile==tileinterdit[i]) {
                        console.log("déplacement bloqué");
                        abscisse = parseInt(abscisse,10) + parseInt(a,10);
                        if (abscisse ==  (parseInt(a,10)-parseInt(a,10))) {
                            abscisse = parseInt(a,10);
                            map_abscisse = parseInt(map_abscisse,10) + parseInt(a,10);
                        }
                    return;
                    }
                }
            }
            
            //si tout est bon envoi
            envoyerDeplacement(abscisse,map_abscisse,ordonnee,map_ordonnee,pseudo);
            deplacement(abscisse, ordonnee, "gauche" ,map_abscisse, map_ordonnee);
        }
        
        if(direction=="droite"){
            abscisse= parseInt(abscisse,10)+parseInt(a,10);
            map_ordonnee = parseInt(map_ordonnee,10);
            map_abscisse = parseInt(map_abscisse,10);
            ordonnee= parseInt(ordonnee,10);
            
            //calcul pour vérifier que la destination existe
            if (parseInt(abscisse,10) > parseInt(largeur_map,10))
                {
				if (parseInt(map_abscisse,10) == parseInt(x_map_abscisse,10))
					{
					abscisse = parseInt(abscisse,10) - parseInt(a,10);
                    return;
					}
				else
					{
					map_abscisse = parseInt(map_abscisse,10) + parseInt(a,10);
					abscisse = parseInt(a,10);
					}
				}
                
            //vérification du fait qu'il n'y ai pas de joueur sur la destination
            for(var i=0; i<=z;i++) {
                if (abscisse==joueurs[i][3][0] && ordonnee==joueurs[i][3][1] && map_abscisse==joueurs[i][3][2] && map_ordonnee==joueurs[i][3][3] && joueurs[i][1]!=pseudo) {
                    abscisse = parseInt(abscisse,10) - parseInt(a,10);
                    if (abscisse ==  (parseInt(largeur_map,10)+parseInt(a,10))) {
                        abscisse = parseInt(largeur_map,10);
                        map_abscisse = parseInt(map_abscisse,10) - parseInt(a,10);
                    }
                    return;
                }
            }
            
            //vérification si il n'y a pas de PNJ sur la destination
            for(var i=0; i<PNJ.length;i++) {
                if (abscisse==PNJ[i][2] && ordonnee==PNJ[i][3] && map_abscisse==PNJ[i][4] && map_ordonnee==PNJ[i][5]) {
                    abscisse = parseInt(abscisse,10) - parseInt(a,10);
                    if (abscisse ==  (parseInt(largeur_map,10)+parseInt(a,10))) {
                        abscisse = parseInt(largeur_map,10);
                        map_abscisse = parseInt(map_abscisse,10) - parseInt(a,10);
                    }
                    return;
                }
            }

            console.log("terrain"+terrain);
            if(terrain){
                var ligne = terrain[(17-ordonnee)];
                var numerodutile = ligne[(abscisse-1)];
                for (var i=0; i<tileinterdit.length; i++) {
                    if (numerodutile==tileinterdit[i]) {
                        console.log("déplacement bloqué");
                        abscisse = parseInt(abscisse,10) - parseInt(a,10);
                        if (abscisse ==  (parseInt(largeur_map,10)+parseInt(a,10))) {
                            abscisse = parseInt(largeur_map,10);
                            map_abscisse = parseInt(map_abscisse,10) - parseInt(a,10);
                        }
                    return;
                    }
                }
            }
            
            //si tout est bon envoi
            envoyerDeplacement(abscisse,map_abscisse,ordonnee,map_ordonnee,pseudo);
            deplacement(abscisse, ordonnee, "droite", map_abscisse, map_ordonnee);
        }
        
        //si direction ne corespond à rien il ne se passe rien
        else{
            return false;
        }
    }

    
    
    
    function envoyerDeplacement(abscisse,map_abscisse,ordonnee,map_ordonnee,pseudo)
    {
        socket.emit('envoie_coordonnee_utilisateur',{
            abscisse: abscisse,
			map_abscisse: map_abscisse,
            ordonnee: ordonnee,
			map_ordonnee: map_ordonnee,
			pseudo: pseudo,
            });
    }   



    //3- on affiche les coordonnees
    socket.on('coordonnee_utilisateur_initial', function (data) {
            $('#deplacement').append( '<div id="'+data.pseudo+'">' + data.pseudo +' est en abscisse '+ data.abscisse+ ' et en ordonnee '+ data.ordonnee+ ', et  dans map, '+ data.pseudo+' est en abscisse '+data.map_abscisse+' et d ordonnee '+data.map_ordonnee+'</div>' );
        });



    socket.on('coordonnee_utilisateur', function (data) {
            $("#"+data.pseudo+"").replaceWith( '<div id="'+data.pseudo+'">' + data.pseudo +' est en abscisse '+ data.abscisse+ ' et en ordonnee '+ data.ordonnee+ ', et  dans map, '+ data.pseudo+' est en abscisse '+data.map_abscisse+' et d ordonnee '+data.map_ordonnee+'</div>' );
            if(data.pseudo==pseudo){
                abscisse= data.abscisse;
                map_abscisse= data.map_abscisse;
                ordonnee= data.ordonnee;
				map_ordonnee= data.map_ordonnee;
                }
        });      


 
    //apelle la fonction qui vas créé le tableau avec toute les info du déplacement
    function deplacement (abscisse, ordonnee, direction, map_abscisse, map_ordonnee) {
        dessinerPersonnage(abscisse, map_abscisse, ordonnee, map_ordonnee, direction);
    }
    
    
    
    socket.on('supprimer_un_utilisateur_dans_liste_utilisateur', function (user) {
        for (var i=0; i<=z; i++) {
            if (user.name == joueurs [i][1]) {
                joueurs [i][4] = 0;
                console.log('joueur suprimé');
            }
        }
    });  

    
   
    //chargement des images
       var imgjoueur = document.getElementById("personnage");
       
      
       
    
    
    socket.on('personnages', function (data) {

        //console.log ('données recuent');
        
        //création ou mise à jour du personnage
        var test = 0;
        var z_test = 0;

        for (var i=0; i<z; i++) {
            if (data.imgdeplacement[1] == joueurs [i][1]) {
                test = 1;
                z_test = i;
            }
        }
       
        if (test) {
            joueurs [z_test] = [];
            joueurs [z_test] = data.imgdeplacement;
            console.log ('joueur mis à jour');
        } else {
            z++;
            joueurs [z] = data.imgdeplacement;
            console.log ('joueur ajouté');
        }
    
        //boucle d'affichage
        
        var boucle = setInterval(function() {
            if(z) {
               // console.log ('entré dans la boucle d affichage');
                var position = String(map_abscisse) + String(map_ordonnee);
                var canvas = document.getElementById('canvas');
                var ctx = canvas.getContext('2d');
                var map = new Map(position);
            
                terrain = affichage_map();
        
                //affichage des pnj
                 
                for (var i=0; i<PNJ.length; i++) {
                    if ( PNJ[i][4]==map_abscisse && PNJ[i][5]==map_ordonnee) {
                       
                        var imgPNJ = document.getElementById(PNJ[i][10]);
                        ctx.drawImage(imgPNJ,PNJ[i][6],PNJ[i][7],PNJ[i][8],PNJ[i][9],(PNJ[i][2]*32)-32,(32*hauteur_map)-(PNJ[i][3]*32),32,32);
                       //console.log ('PNJ affiché');
                    }
                }
        
                //affichage des monstres
                var nbre_monstre=MONSTRE['nbre_monstre'];
                for (var p=0; p<nbre_monstre; p++) {     
                    if ( MONSTRE[p][3]==map_abscisse && MONSTRE[p][4]==map_ordonnee) {
                         var image_monstre= document.getElementById(MONSTRE[p][8]);
                        ctx.drawImage(image_monstre,0,0,32,32,(MONSTRE[p][1]*32)-32,(32*hauteur_map)-(MONSTRE[p][2]*32),32,32);
                        //console.log ('monstre affiché');
                    }
                }
        
                //affichage des joueurs
                for (var m=0 ; m<z ; m++) {
                   
                    if (map_abscisse==joueurs[m][3][2] && map_ordonnee==joueurs[m][3][3] && joueurs[m][4]==1) {
                        ctx.drawImage(imgjoueur, joueurs[m][0][(joueurs[m][2])][0], joueurs[m][0][(joueurs[m][2])][1], joueurs[m][0][(joueurs[m][2])][2], joueurs[m][0][(joueurs[m][2])][3], joueurs[m][0][(joueurs[m][2])][4], joueurs[m][0][(joueurs[m][2])][5], joueurs[m][0][(joueurs[m][2])][6], joueurs[m][0][(joueurs[m][2])][7]);
                        //console.log ('joueur affiché');
                    }
                    if (joueurs[m][2]<15) {
                        joueurs[m][2]++;
                    }
                }
            }
        }, 70);
    });
    