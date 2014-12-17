<?php
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("../include/entete.php");

?>
<img id="personnage" src="http://ageofsurvival.koding.com/jeu/sprites/personnage.png" style="display:none">
<img id="pnj_0" src="http://ageofsurvival.koding.com/jeu/sprites/pnj_0.png" style="display:none">
<img id="pnj_1" src="http://ageofsurvival.koding.com/jeu/sprites/pnj_1.png" style="display:none">
<img id="monstre_0" src="http://ageofsurvival.koding.com/jeu/sprites/monstre_0.png" style="display:none">
<img id="monstre_1" src="http://ageofsurvival.koding.com/jeu/sprites/monstre_1.png" style="display:none">
<?php

// La session est démarré gâce à l'include au dessus
// On associe les sessions à des variables plus simple à manipuler

    $pseudo=$_SESSION['login'];
    $mot_de_passe=$_SESSION['mot_de_passe'];

    // On vérifie que la session est bien active pour effectuer ensuite une connexion autrement on le redirige vers la page de connexion

    if ($_SESSION['activation'] != "oui"){
        ?>
        <script> 
            window.location='http://ageofsurvival.koding.com/membres/connexion.php';
        </script> 
       <?php
    }
    
   // On récupère les infos du joueur  dans une basse de donnée 
    require "../connect/connect2.php";   
    $sql='SELECT * FROM deplacement WHERE pseudo= \'' . $pseudo . '\' ';
    $req= mysql_query($sql) or die (mysql_error());
    	$data = mysql_fetch_array($req);
		$d["erreur"]="ok";
		$map_abscisse=$data['map_abscisse'];
        $map_ordonnee=$data['map_ordonnee'];
		$abscisse=$data['abscisse'];
		$ordonnee=$data['ordonnee'];
        
   // On récupère les infos du joueur pour son inventaire  dans une basse de donnée 
    require "../connect/connect2.php";   
    $sql2='SELECT * FROM inventaire WHERE pseudo= \'' . $pseudo . '\' ';
    $req2= mysql_query($sql2) or die (mysql_error());
        $data2 = mysql_fetch_array($req2);
		$d["erreur"]="ok";
		$epee=$data2['epee'];
        $jambon=$data2['jambon'];
		$vie=$data2['vie'];
		$xp=$data2['xp'];
        $pomme=$data2['pomme'];
?>







<!--inclusion de jquery-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<!--inclusion du code javascript pour aficher une tchatbox-->
<script type="text/javascript" src="/jeu/js/bootstrap.js"></script>

<script type="text/javascript">
    // On transforme les variables php en varaible javascript
    var pseudo = '<?php echo $pseudo; ?>'; 
    var mot_de_passe = '<?php echo $mot_de_passe; ?>';
    var map_abscisse= '<?php echo $map_abscisse; ?>';
    var map_ordonnee= '<?php echo $map_ordonnee; ?>';
    var abscisse= '<?php echo $abscisse; ?>';
    var ordonnee='<?php echo $ordonnee; ?>';
    var epee='<?php echo $epee; ?>';
    var jambon='<?php echo $jambon; ?>';
    var vie='<?php echo $vie; ?>';
    var xp='<?php echo $xp; ?>';
    var pomme='<?php echo $pomme; ?>';
</script>

<!-- On récupère la librairie socket.io -->
<script type="text/javascript" src="http://ageofsurvival.koding.com:8082/socket.io/socket.io.js"></script> 


<script type="text/javascript">
        /* initialisation de la connexion au serveur*/
    var socket = io.connect('http://ageofsurvival.koding.com:8082'); // On se connecte au serveur
</script>       
    
    
    
    <!-- .................................
        1- GESTION DES UTILISATEURS
    ................................. -->
    

<script type="text/javascript" src="gestion_user.js"></script>


<script>
        
socket.on('multi_onglet', function(data){
        if (data == pseudo){
            window.location='http://ageofsurvival.koding.com';
        }
	});
	
</script>	
	
    
    
    <!-- .................................
        2- GESTION MAP
    ................................. --> 
    
    
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/test_navigateur.js"></script>
<script type="text/javascript" src="js/classes/Tileset.js"></script>
<script type="text/javascript" src="js/classes/Map.js"></script>
<script type="text/javascript" src="js/rpg.js"></script>

    
    
    <!-- .................................
    3- GESTION DES DEPLACEMENTS
    ................................. -->
    
    
<script type="text/javascript" src="/jeu/js/classes/obj_personnage.js"></script>
<script type="text/javascript" src="gestion/gestion_pnj.js"></script>
<script type="text/javascript" src="gestion/gestion_monstre.js"></script>
<script type="text/javascript" src="gestion_deplacement.js"></script>

   
    
    <!-- .................................
    4-Enregistrement des données
    ................................. --> 
    
    
<script type="text/javascript" src="enregistrement_donnee.js"></script>



   
<!--inclusion du css particulier à la ^page (police...)-->
<link rel="stylesheet" type="text/css" href="css/style.css" />  
<link href='http://fonts.googleapis.com/css?family=Elsie+Swash+Caps:400,900' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]><script type="text/javascript" src="js/excanvas.compiled.js"></script><![endif]-->



    <!-- .................................
    4-AFFICHAGE GRAPHIQUE
    ................................. -->


    <div  id="jeu">   
   
        <canvas id="canvas"></canvas>

            <!-- .................................
            4.1- TCHAT
           ................................. -->

        <div id="tchat">

            <!-- .................................
                4.1- TCHAT - Envoie
            ................................. -->
               
            <div class="tab-content">
                <div class="tab-pane " id="Tchat">
                <!--  Tchat Génaral -->
                <div id="affichageMessage">
                </div>
            </div>
            <div class="tab-pane active" id="PNJ">
                <!--  Tchat PNJ -->
                <div id="affichageMessagePNJ">
                </div>
            </div>
                <div class="tab-pane " id="Attaque">
                    <!--  Attaque Génaral -->
                    <div id="affichageMessageAttaque">
                    </div>
                </div>
            </div>
          
                 

               <!-- .................................
                4.1- TCHAT - Formulaire
               ................................. -->
               <p>
               </p>
               <ul class="nav nav-tabs" id="myTab">
                    <li><a href="#Tchat">Tchat</a></li>
                    <li class="active"><a href="#PNJ">PNJ</a></li>
                    <li><a href="#Attaque">Attaque</a></li>
                </ul>
                <p></p>
                <h2>Envoyer un message </h2>
                <p></p>
                <form action="" id="form">
                    <input type="text" id="message" class="text" placeholder="Votre message"/>
                    <input type="submit" id="send" value="Envoyer mon message !" class="submit"/>
                </form>


                <script type="text/javascript" src="tchat.js"></script>
               
                <script>
                  $('#myTab a').click(function (e) {
                  e.preventDefault();
                  $(this).tab('show');
                })
                </script>
            </div>
        </div>


        <!-- .................................
            4.2- MENU
           ................................. -->
           
           <!-- iNCLUSION DES Js nécessaire au menu -->
           
           <div id='info'>
                <table>
                <!-- En-tête du tableau -->
       
                <!-- Corps du tableau -->
        <tbody>
        <tr>
             <td>
                    <!-- .................................
                    4.2.1 Boîte de dialogue pour les connectés
                    .................................  -->
                 
                    <!-- Lien pour voir les connectés -->

                    <a href="#" class="bouton" data-reveal-id="modal-utilisateurs">Joueur(s) en ligne</a> 


                    <!--  Contenu de la boîte qui s'affiche -->

                    <div id="modal-utilisateurs" class="reveal-modal">

                        <h1>Joueur(s) en ligne</h1>
                             <div id="utilisateurs"></div>
                            <a class="close-reveal-modal">&#215;</a>
                     </div>

                    <!--  Javascript pour affichar la boite de dialogue-->

                         <script type="text/javascript">
                        $(document).ready(function() {
                             $('#myButton').click(function(e) {
                                  e.preventDefault();
                              $('#modal-utilisateurs').reveal();
                             });
                        });
                        </script>  

            </td>
            <td>
                VIE : 
            </td>
             <td>
                    
                   <div class="progress progress-striped active">
                    <div class="bar" id="vie" style="width: 100%; background-color: #E7351D;"></div>
                    <script type="text/javascript" src="gestion/gestion_vie.js"></script>
                    </div>
            </td>
            
                 <td>
                    <div id="1" class="inventaire">
                        <img src="http://ageofsurvival.koding.com/jeu/images/jambon.png" alt="Viande" onClick=Vie()>
                        <div id="compteur_viande"></div>
                        <script type="text/javascript" src="gestion/gestion_jambon.js"></script>
                        
                    </div>
                </td>
                <td>
                    <div id="2" class="inventaire">
                        <img src="http://ageofsurvival.koding.com/jeu/images/pomme.png" alt="pomme" onClick=Vie2()>
                         <div id="compteur_pommes"></div>
                        <script type="text/javascript" src="gestion/gestion_pomme.js"></script>
                    </div>
                </td>
                 <td>
                    <div id="3" class="inventaire">
                        <img src="http://ageofsurvival.koding.com/jeu/images/epee.png" alt="epee">
                        <script type="text/javascript" src="gestion/gestion_epee.js"></script>
                    </div>
                 </td>
                  <td>
                    <div id="4" class="inventaire">
                     <img src="http://ageofsurvival.koding.com/jeu/images/arc.png" alt="epee">
                    </div>
                 </td>
            
                       
       </tr>
       <tr>
            <td>
                    <!--  .................................
                    4.2 Boîte de dialogue pour les positions des joueurs ( en cours)
                    ................................. -->

                        <!-- Lien pour voir les connectés -->
                                   
                    <a href="#" class="bouton" data-reveal-id="modal-position">Position de(s) joueurs(s)</a>    

                    <!--  Contenu de la boîte qui s'affiche -->   

                    <div id="modal-position" class="reveal-modal">
                        <h1>Position de(s) joueurs(s):</h1>
                            <div id="deplacement"></div>
                            <a class="close-reveal-modal">&#215;</a>
                     </div>

                     <!--  Javascript pour affichar la boite de dialogue-->

                         <script type="text/javascript">
                        $(document).ready(function() {
                             $('#myButton').click(function(e) {
                                  e.preventDefault();
                              $('#modal-position').reveal();
                             });
                        });
                        </script>     
                    
            </td>
            <td>
                XP : 
            </td>
             <td>
                   <div class="progress progress-striped active">
                    <div id="xp" class="bar" style="width: 40%;  background-color: blue;"></div>
                    <script type="text/javascript" src="gestion/gestion_xp.js"></script>
                    </div>
            </td>
            
          
       </tr>
          
       
        </tbody>
    </table> 
      
</div> 

</div>  
</html>
<script>
window.onload = function() {
controle_clavier();
affichage_map();
}

</script>


<div class="wrap">
        <div class="exemple">
            <audio src="/jeu/musique/Evenstar.mp3" id="lecteur"></audio>
            <div>
                <button onclick="document.getElementById('lecteur').play()">Play</button>
                <button onclick="document.getElementById('lecteur').pause()">Pause</button>
                <button onclick="document.getElementById('lecteur').volume+= 0.2">Volume +</button>
                <button onclick="document.getElementById('lecteur').volume-= 0.2">Volume -</button>
            </div>
        </div>
    </div>


