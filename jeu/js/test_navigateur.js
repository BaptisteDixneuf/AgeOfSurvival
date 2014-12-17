/* ** Support par les différents navigateurs********************************************************************* */
/* Script complet de gestion d'une requête de type XMLHttpRequest                     */
/* Par Dixneuf Baptiste                                      */
/* ********************************************************************************** */

function getXMLHttpRequest() {
	var xhr2 = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr2 = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr2 = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr2 = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr2;
}
