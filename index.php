<?php
$description_de_la_page = "Age of Survival google";
$mot_cle_de_la_page = "Age of Survival";
$auteur_de_la_page = "Dixneuf Baptiste";
$titre = "Age of Survival";

require("include/entete.php");

?>

<div  class="row">
     <?php 
         if ($_SESSION['activation'] == "oui"){
             ?>
            <div class="seven columns">
             <div class="alert-box success">
              Bienveue <?php echo htmlentities(trim($_SESSION['login'])); ?>, sur Age Of Survival.
             </div>
             </div>
    <?php
          }
                  
     ?>
     
     
  <div class="seven columns">
     <div class="panel">
   
     
        <div class="page-header">

            <h1> Actualité </h1>

            Informations capitales :)

        </div>

       

            <?php
            
            $doc_root = (substr($_SERVER["DOCUMENT_ROOT"], -1) == '/') ? substr($_SERVER["DOCUMENT_ROOT"], 0, -1) : $_SERVER["DOCUMENT_ROOT"];

            require($doc_root . "/actualite.php");

            ?>

        

        </div>



        <div class="five columns">
        <div class="panel">

          


                <div  class="page-header">

                    <h1>  Présentation du projet </h1>

                    Présentation du projet

                </div>

                Age of Survival- Test de présentation
                <iframe src="http://prezi.com/embed/q6v_xtgilbze/?bgcolor=ffffff&amp;lock_to_path=0&amp;autoplay=no&amp;autohide_ctrls=0&amp;features=undefined&amp;disabled_features=undefined" width="450" height="300" frameBorder="0"></iframe>

            </div>
            
            <div class="panel">
                <div  class="page-header">

                    <h1> Actu du projet </h1>

                    

                </div>
                   <a class="twitter-timeline" href="https://twitter.com/AgeOfSurvival" data-widget-id="321992152144023552">Tweets de @AgeOfSurvival</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>


        </div>

    </div>


    <!-- Pied de page

              ================================================== -->


<?php require("include/pieddepage.php"); ?> 


</div>    

</body>

</html>