<!-- On enregistre toute les ip pour garder une trace des logs

================================================== -->
        <?php
         
         // Savoir l'ip de l'utilisateur
          
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $IP = $_SERVER['HTTP_X_FORWARDED_FOR'] ;
            elseif(isset($_SERVER['HTTP_CLIENT_IP']))
                $IP = $_SERVER['HTTP_CLIENT_IP'] ;
            else
                $IP = $_SERVER['REMOTE_ADDR'] ;
                
                
                
              
              $Cherche_IP="initialisation";
              $Date_comp="initialisation";
              $Date = date('Y-m-d', mktime(date('H')+9, date('i'), date('s') , date('m'), date('d'), date('Y')));
             
              
             
                    //connexion à la bdd
                        //Il faudrai sécuriser le require si jamais celui ne fonctionne pas.
                          //Si $_SERVER["DOCUMENT_ROOT"] contient '/' en dernier caractère $doc_root contient $_SERVER["DOCUMENT_ROOT"] - le '/', sinon $doc_root contient $_SERVER["DOCUMENT_ROOT"]
                          $doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];
             
                         require($doc_root."/connect/connect.php");
            
                 
            
            
                // On récupère tout le contenu de la table Liste_IP
                $reponse = $bdd->query('SELECT * FROM liste_ip');
              
                //On vérifie si l'IP est déja répertoriée
              while ($donnees = $reponse->fetch())
              {
                if($IP == $donnees['IP'])
                  {
                    $Date_bdd = $donnees['Date'];
                    $Messages_bdd = $donnees['Messages'];
                    
                    $Cherche_IP = "OK";
                   
                  }    
              }
              
              //Si l'IP n'est pas répertoriée, on l'insère
              if($Cherche_IP != "OK")
                {
                  $Messages = 1;
                  $req = $bdd->prepare('INSERT INTO liste_ip(IP, Date, Messages) VALUES(:IP, :Date, :Messages)');
                  $req->execute(array(
                  'IP' => $IP,
                  'Date' => $Date,
                  'Messages' => $Messages
                  ));
                }    
                
              
                
              //Si elle l'est, on verifie si la date est la même qu'aujourd'hui
              if($Cherche_IP == "OK")
                {
                   
                  $Date=str_replace ( "/","-", $Date) ; // On remplace les slashs par de"s tirests
                  
                     
                 
                  if ($Date == $Date_bdd)
                    {
                      $Date_comp = "OK";
                       
                    }
                }
              
              //Si la date n'est pas identique
              if ($Date_comp != "OK")
                {
                  $Messages = 0;      
                  $req = $bdd->prepare('UPDATE liste_ip SET Date = :Date, Messages = :Messages WHERE IP = :IP');
                  $req->execute(array(
                  'IP' => $IP,
                  'Date' => $Date,
                  'Messages' => $Messages
                  ));
                }
              
              //Si la date est identique
              if ($Date_comp == "OK")
                {
                  $Messages = $Messages_bdd + 1;      
                  $req = $bdd->prepare('UPDATE liste_ip SET Date = :Date, Messages = :Messages WHERE IP = :IP');
                  $req->execute(array(
                  'IP' => $IP,
                  'Date' => $Date,
                  'Messages' => $Messages
                  ));
                }
        
          
            
          ?>
          
          
          
          
          
          
          
          
          <?php
              
          $reponse->closeCursor(); // Termine le traitement de la requête
                
        ?>

<!--  On enregistre toutes les pages vues pour aussi avoir des logs des erreurs éventuelles

================================================== -->

<?php

 

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $IP = $_SERVER['HTTP_X_FORWARDED_FOR'] ;
    elseif(isset($_SERVER['HTTP_CLIENT_IP']))
        $IP = $_SERVER['HTTP_CLIENT_IP'] ;
    else
        $IP = $_SERVER['REMOTE_ADDR'] ;
    
    $Page = $_SERVER['REQUEST_URI'];
    $Date = date('Y-m-d H:i:s', mktime(date('H')+9, date('i'), date('s'), date('m'), date('d'), date('Y')));
    
    //connexion
    //connexion à la bdd
    //Il faudrai sécuriser le require si jamais celui ne fonctionne pas.
    //Si $_SERVER["DOCUMENT_ROOT"] contient '/' en dernier caractère $doc_root contient $_SERVER["DOCUMENT_ROOT"] - le '/', sinon $doc_root contient $_SERVER["DOCUMENT_ROOT"]
    $doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];
    
    require($doc_root . "/connect/connect.php");
    
    
    $req = $bdd->prepare('INSERT INTO page_vue(Page, IP, Date) VALUES(:Page, :IP, :Date)');
    $req->execute(array(
        'Page' => $Page,
        'IP' => $IP,
        'Date' => $Date
    ));
    ?>
    
    <?php
    
    $req->closeCursor(); // Termine le traitement de la requête
    
?>
  
  
 


<footer id="pied_de_page">
  
  <div class="row">
  
    
    <div id="bloc_pied" class="three columns">
       <h3>Mentions Légales</h3>
        <li>  <a  href="<?php echo URLRACINE; ?>mentionslegales.php"> Les Mentions Légales</a></li>
       <li>Interdiction de Reproduction</li>
      <li>© 2012 Age of Survival </li>
      <li>Tous Droits Réservés</li>
    </div>
    
 <div id="bloc_pied" class="four columns">
    <h3><i class="icon-user icon-white"></i> Age of Survival</h3>
    <li>Adresse mail: ageofsurvival@gmail.com</li>
    <li>S'abonner</li>
    <p>
    <a href="<?php echo URL_PAGE_GOOGLE; ?>" rel="publisher" style="text-decoration:none;">
    <img src="<?php echo URLRACINE; ?>images/reseau/gplus-32.png" alt="google+" style="border:0;width:32px;height:32px;"/></a>
  
    <a href="<?php echo URL_PAGE_FACEBOOK; ?>">
    <img src="<?php echo URLRACINE; ?>images/reseau/facebook.png" alt="facebook"></a>
  
    <a href="<?php echo URL_PAGE_TWITTER; ?>">
   <img src="<?php echo URLRACINE; ?>images/reseau/twitter.png" alt="twitter"></a>
      
          </p>
      
      
         </div>
    
  <div id="bloc_pied" class="five columns">
    <h3>Publicité</h3>
    
      

    
    
    



</div>    

  </div>    

  </footer>

<!-- Included JS Files (Compressed) -->
  <script src="<?php echo URLRACINE; ?>foundation/javascripts/jquery.js"></script>
  <script src="<?php echo URLRACINE; ?>foundation/javascripts/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <script src="<?php echo URLRACINE; ?>foundation/javascripts/app.js"></script>
  </body>
</html>