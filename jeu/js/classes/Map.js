function Map(nom) {
	// Création de l'objet XmlHttpRequest
	var xhr2 = getXMLHttpRequest();
		
	// Chargement du fichier
	xhr2.open("GET", './maps/' + nom + '.json', false);
	xhr2.send(null);
	if(xhr2.readyState != 4 || (xhr2.status != 200 && xhr2.status !== 0)) // Code == 0 en local
		throw new Error("Impossible de charger la carte nommée \"" + nom + "\" (code HTTP : " + xhr2.status + ").");
	var mapJsonData = xhr2.responseText;
	
	// Analyse des données
	var mapData = JSON.parse(mapJsonData);
	this.tileset = new Tileset(mapData.tileset);
	this.terrain = mapData.terrain;
    terrain=this.terrain;
}


Map.prototype.dessinerMap = function(context,terrain) {
    this.terrain=terrain;
	for(var i = 0, l = this.terrain.length ; i < l ; i++) {
		var ligne = this.terrain[i];
		var y = i * 32;
		for(var j = 0, k = ligne.length ; j < k ; j++) {
			this.tileset.dessinerTile(ligne[j], context, j * 32, y);
		}
	}
}