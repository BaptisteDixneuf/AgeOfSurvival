/*<------------------------->
     1- GESTION DES UTILISATEURS
    <-------------------------->*/
    
            // on se connnecte en crent un evenement appele connection pour creer la socket
            socket.emit('connection');

            // sur la socket on envoie notre pseudo et mdp pour s'identifier au serveur
            socket.emit('connexion_utilisateur',{
                pseudo: pseudo,
                mot_de_passe: mot_de_passe,
            });

            // On ecoute la reponse du serveur qui nous renvoie un evenement liste_utilisateur a chaque fois qu'un utilisateur se connecte   
            // On affcihe ce nouveau utilisateur grace a du jquery
            
            socket.on('liste_utilisateur', function (utilisateur) {
                 $('#utilisateurs').append( '<div id="'+utilisateur.id+'">' + utilisateur.name +'</div>' );
            });        

            // On ecoute la reponse du serveur qui nous renvoie un evenement supprimer_un_utilisateur_dans_liste_utilisateur a chaque fois qu'un utilisateur se deconnecte   
            // On enleve cet utilisateur de la liste des utilisateurs grace a du jquery        
            socket.on('supprimer_un_utilisateur_dans_liste_utilisateur', function (user) {
                $("#"+user.id).remove();
            });      