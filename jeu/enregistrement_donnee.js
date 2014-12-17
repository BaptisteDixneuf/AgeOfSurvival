/*<------------------------->
    3-Enregistrement des deplacements
    <-------------------------->*/  
     
	//1-On definit les variables qu'il faut pour executer le code suivant
		var url= "jeuAjax.php";
	
	      
	
	function enregistrement_donnee(abscisse,ordonnee,map_abscisse,map_ordonnee,epee,jambon,vie,xp)
	{
	
        $.post(url,{action:"enregistrement_donnee",abscisse:abscisse,ordonnee:ordonnee,map_abscisse:map_abscisse,map_ordonnee:map_ordonnee,epee:epee,jambon:jambon,vie:vie,xp:xp,pomme:pomme},function(data){
       		
    },"json")
	};
	
	setInterval("enregistrement_donnee(abscisse,ordonnee,map_abscisse,map_ordonnee,epee,jambon,vie,xp)",20000);
 
