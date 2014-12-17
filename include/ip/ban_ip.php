<!--Fichier ban
================================================== -->
  <?php
  //Fonction Récupération de l'adrrese ip

          if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }
                  
          else{
             $ip = $_SERVER['REMOTE_ADDR'];
          }
                 
       
      //connexion à la bdd
       // $fichier_require= URLRACINE."connect/connect.php";
       // echo $fichier_require;
      
       // require("connect/connect.php");  
       //Si $_SERVER["DOCUMENT_ROOT"] contient '/' en dernier caractÃ¨re $doc_root contient $_SERVER["DOCUMENT_ROOT"] - le '/', 
            // sinon $doc_root contient $_SERVER["DOCUMENT_ROOT"]
       
       
      $doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];
          
       require($doc_root . "/connect/connect.php");


       
      
         

                                                      
          
        $reponse = $bdd->query('SELECT * FROM ban');

        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch())
        {
              //echo "IP_user:";
            //echo $ip;
            // echo "<br>";
            // echo "IP_db:";
             // echo $donnees['ban_ip'];
          
            if($ip==$donnees['ban_ip']){
            require('interdiction.html');
            exit;
                          
        } 
    }
       $reponse->closeCursor(); // Termine le traitement de la requête
                  
  ?>