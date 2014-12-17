// Création du serveur http

var http = require('http');
server = http.createServer(function (req, res) {
}).listen(8082);

// Message de vérification pour vérifier si le serveur http est lancé
console.log('Serveur tourne sur http://127.0.0.1:8082/');

// On récupère la librairie socket.io
var io = require("socket.io").listen(server);


    /*-----------------------
        gestion du jeu
    -----------------------*/
    

var users = {}; // liste des utilisateurs
var z = 0; // compteur pour les id des joueurs



MONSTRE_CARACTERISTIQUES= {};
        
function Monstre_Caracteristiques(id,vie_max_monstre,perte_de_vie_attaque,nom_image,nom) {
    MONSTRE_CARACTERISTIQUES[id]=new Array(4);
    MONSTRE_CARACTERISTIQUES[id]=[id,vie_max_monstre,perte_de_vie_attaque,nom_image,nom];
    }
    
    // Déclaratiobn des différents types de monstres
      
    monstre_caracteristiques0= Monstre_Caracteristiques(0,200,-10,"monstre_0","Petit Dragon");
    monstre_caracteristiques1= Monstre_Caracteristiques(1,1200,-20,"monstre_1","Grand Dragon");
    var nbre_de_type_de_monstre=2;
    console.log(MONSTRE_CARACTERISTIQUES);


var MONSTRE = {};
function Monstre (id,abscisse,ordonnee,map_abscisse,map_ordonnee,type){
        
       // Et le type permet de définir les caractéristiques du monstre
        MONSTRE[id]=new Array(8);
        MONSTRE[id][0]=id;
        MONSTRE[id][1]=abscisse;
        MONSTRE[id][2]=ordonnee;
        MONSTRE[id][3]=map_abscisse;
        MONSTRE[id][4]=map_ordonnee;
        MONSTRE[id][5]=MONSTRE_CARACTERISTIQUES[type][1]; //vie  du monstre en fonction du type
        MONSTRE[id][6]=MONSTRE_CARACTERISTIQUES[type][4]; //nom  du monstre en fonction du type
        MONSTRE[id][7]=MONSTRE_CARACTERISTIQUES[type][2]; //qté de vie perdue en fonction du type
        MONSTRE[id][8]=MONSTRE_CARACTERISTIQUES[type][3]; // Image du monstre a apelle en fonction du type
    }
    
    /* Initialisation des monstres */
    
    monstre0= Monstre(0,3,1,1,1,0);
    monstre1= Monstre(1,9,14,1,1,0);
    monstre2= Monstre(2,6,12,1,2,0); 
    monstre3= Monstre(3,6,8,1,2,0);
    monstre4= Monstre(4,15,5,2,1,0);
    monstre5= Monstre(5,8,12,2,1,1);
    monstre6= Monstre(6,23,6,2,2,1);
    monstre7= Monstre(7,12,9,2,2,1);
    MONSTRE['nbre_monstre']=8;
   
   



// Quand il y a un événement connection
io.sockets.on('connection', function(socket)
{
    
    var current_user = {} ;
    
    console.log('Nouveau utilisateur connecté avec une socket');
    
    
    /*
     GESTION DES UTILISATEURS
    */
    
            /*Après être connecté, on récupère les utilisateurs connectés avant
            en parcourant le tableau des utilisateurs connectés qui est en prmanence mis à jour 
            quand un utilisateur se connecte
            et quand il se deconnecte */

    for ( var k in users)
        {
        console.log('L utilisateur qui se connecte recupere les connectes');
        socket.emit('liste_utilisateur', users[k]);
        }

            /*On se connecte nous aussi au jeu 
            On enregistre notre pseudo dans la liste des utlisateurs
            on lui attribue un id unique pour chaque utilisateur
            On envoie notre présence aux autres */


    socket.on('connexion_utilisateur', function(utilisateur) 
        {
        console.log('Nouveau utilisateur s enregistre');
        current_user.name = utilisateur.pseudo;
        current_user.id = ++z;
		for ( var k in users)
			{
			if (users[k].name==current_user.name)
				{
				console.log('utilisateur en multi onglet');
				io.sockets.emit('multi_onglet',users[k].name);
				}
			}
        users[current_user.id] = current_user;
		io.sockets.emit('liste_utilisateur',current_user);
        io.sockets.emit('monstre', MONSTRE);   
        console.log("Monstre initialisé");
        });



            /* Le serveur envoie gràce à la librairie socket.io un event disconnet si l'utilisateur ferme la fenêtre
            On enlève l'utilisateur de la liste des utilisateurs
            On envoie cette info aux autres joueurs en lignes pour qu'ensuite ils disparraissent de la liste des connectés */

    socket.on('disconnect', function()
        {
        console.log('Un utilisateur se deconnecte'); 
        delete users [current_user.id];
        io.sockets.emit('supprimer_un_utilisateur_dans_liste_utilisateur', current_user);
        });
    
    
    
        /*
        GESTION DES DEPLACEMENTS
        */
    

    socket.on('envoie_coordonnee_utilisateur_initial', function (data) 
        {
        io.sockets.emit('coordonnee_utilisateur_initial', data);
        });


    socket.on('envoie_coordonnee_utilisateur', function (data) 
        {
        io.sockets.emit('coordonnee_utilisateur', data);
        });

    socket.on('envoi_deplacement', function (data)
        {
        io.sockets.emit('personnages', { 'imgdeplacement': data,} );
        });


        /*
       TCHAT
        */
    socket.on('creation_message', function (data) 
        {
        io.sockets.emit('envoie_message', data);
        });
        
        
        
        /*
         MONSTRES
        */
     
    socket.on('envoie_attaque', function (data) 
        {
        var largeur_map = 33;
        var hauteur_map = 17;
        var x_map_abscisse = 2;
        var y_map_ordonnee = 2;

        id_monstre=data.monstre[0];
        vie_avant_attaque=MONSTRE[id_monstre][5];
        vie_apres_attaque=vie_avant_attaque+MONSTRE[id_monstre][7];
        if(vie_apres_attaque<=0){
            
                //On génére des coordonnées au hasard.
            var futur_abscisse = Math.floor ( Math.random() * largeur_map +1 ); //permet de générer un nbre entre 1 et largeur_map
            var futur_ordonnee = Math.floor ( Math.random() * hauteur_map +1 ); //permet de générer un nbre entre 1 et hauteur_map
            var futur_map_abscisse = Math.floor ( Math.random() * x_map_abscisse +1 ); //permet de générer un nbre entre 1 et x_map_abscisse
            var futur_map_ordonnee = Math.floor ( Math.random() * y_map_ordonnee +1 ); //permet de générer un nbre entre 1 et y_map_ordonnee
            var futur_type=Math.floor ( Math.random() * nbre_de_type_de_monstre ); //permet de générer un nbre entre 0 et nbre_de_type_de_monstre-1

                //numero, abscisse, ordonnee,maps_abscisse,map_ordonnee,nom,point_de_vie
            MONSTRE[id_monstre][1]=futur_abscisse;
            MONSTRE[id_monstre][2]=futur_ordonnee;
            MONSTRE[id_monstre][3]=futur_map_abscisse;
            MONSTRE[id_monstre][4]=futur_map_ordonnee;
            MONSTRE[id_monstre][5]=MONSTRE_CARACTERISTIQUES[futur_type][1]; //vie  du monstre en fonction du type
            MONSTRE[id_monstre][6]=MONSTRE_CARACTERISTIQUES[futur_type][4]; //nom  du monstre en fonction du type
            MONSTRE[id_monstre][7]=MONSTRE_CARACTERISTIQUES[futur_type][2]; //qté de vie perdue en fonction du type
            MONSTRE[id_monstre][8]=MONSTRE_CARACTERISTIQUES[futur_type][3]; // Image du monstre a apelle en fonction du type
        }else{
            MONSTRE[id_monstre][5]=vie_apres_attaque;
            }
            
            
        io.sockets.emit('monstre', MONSTRE);    
    });

});