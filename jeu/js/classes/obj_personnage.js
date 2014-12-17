
var DUREE_ANIMATION = 4;
var DUREE_DEPLACEMENT = 15;


    
function dessinerPersonnage(x, map_abscisse, y, map_ordonnee, direction) {
    
    var imgdeplacement = new Array(4);
    imgdeplacement [0] = new Array(15);
    
	// Chargement de l'image dans l'attribut image
    this.image = new Image();
	this.image.referenceDuPerso = this;
   
	this.image.onload = function() {
		if(!this.complete){ 
            alert("Erreur de chargement du sprite");
		}
		// Taille du personnage
		this.referenceDuPerso.largeur = this.width / 4;
		this.referenceDuPerso.hauteur = this.height / 4;
	};
    this.image.src = "http://ageofsurvival.koding.com/jeu/sprites/personnage.png";
    
    
    var frame = 0; // Numéro de l'image à prendre pour l'animation
    var decalageX = 0, decalageY = 0; // Décalage à appliquer à la position du personnage
    var nbdirection;
        
    for ( var etatAnimation=0; etatAnimation<=15; etatAnimation++) {
            
            // On calcule l'image (frame) de l'animation à afficher
            frame = Math.floor(etatAnimation / DUREE_ANIMATION);
            if(frame > 3) {
                frame %= 4;
            }
            
            // Nombre de pixels restant à parcourir entre les deux cases
            var pixelsAParcourir = 32 - (32 * (/*this.*/etatAnimation / /*DUREE_DEPLACEMENT*/ 15));
	
            // À partir de ce nombre, on définit le décalage en x et y.
            if(direction =='haut') {
                nbdirection=3;
                decalageY = pixelsAParcourir;
            } else if(direction == 'bas') {
                nbdirection=0;
                decalageY = -pixelsAParcourir;
            } else if(direction == 'gauche') {
                nbdirection=1;
                decalageX = pixelsAParcourir;                
            } else if(direction == 'droite') {
                nbdirection=2;
                decalageX = -pixelsAParcourir;
            }
    
    //inclusion des valeur dans le tableau
        imgdeplacement [0] [etatAnimation] = new Array (8);
        imgdeplacement [0] [etatAnimation] [0] = this.largeur * frame;
        imgdeplacement [0] [etatAnimation] [1] = nbdirection * this.hauteur;
        imgdeplacement [0] [etatAnimation] [2] = this.largeur;
        imgdeplacement [0] [etatAnimation] [3] = this.hauteur;
        imgdeplacement [0] [etatAnimation] [4] = (x * 32) - (this.largeur/ 2) + decalageX - 16;
        imgdeplacement [0] [etatAnimation] [5] = ((17-y) * 32) - this.hauteur + 24 + decalageY;
        imgdeplacement [0] [etatAnimation] [6] = this.largeur;
        imgdeplacement [0] [etatAnimation] [7] = this.hauteur;

    }
    
    //inclusion des info complémentaire dans le tableau
    imgdeplacement [1] = pseudo;
    imgdeplacement [2] = 0;
    imgdeplacement [3] = new Array(7);
        imgdeplacement [3] [0] = x;
        imgdeplacement [3] [1] = y;
        imgdeplacement [3] [2] = map_abscisse;
        imgdeplacement [3] [3] = map_ordonnee;
        imgdeplacement [3] [4] = direction;
        imgdeplacement [3] [5] = "image";
    imgdeplacement [4] = 1;

    socket.emit ('envoi_deplacement', imgdeplacement);
    console.log ('donnée envoyée');
    console.log (imgdeplacement);
 
}
