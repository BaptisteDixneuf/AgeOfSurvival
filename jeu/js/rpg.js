var position = String(map_abscisse) + String(map_ordonnee);
var map = new Map(position);
function affichage_map() {
    var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
    canvas.width  = 34*32;
	canvas.height = 17* 32;
    map.dessinerMap(ctx,terrain);
};

