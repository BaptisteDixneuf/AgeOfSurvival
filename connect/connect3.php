<?php

$adresse='mysql0.db.koding.com';
$nom_bdd='ageofsurvival_fi';
$utilisateur='ageofsurvival_fi';
$mot_de_passe='TrMTbR1_HedCYiBeLuvu4UvWAJLPLzKj8y12ZDhu';

// On se connecte à MySQL
try
{			
				$pdo_options=array( // Options de PDO
				 PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, // On veut des exceptions
				 1002=>'SET NAMES utf8' // On veut de l'utf-8 en encodage
				);
}
catch(Exception $e)
{
    // En cas d'erreur prÃ©cÃ©demment, on affiche un message et on arrÃªte tout
    die('Erreur : '.$e->getMessage());
}



				    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				   $bdd = new PDO('mysql:host='.$adresse.';dbname='.$nom_bdd, $utilisateur, $mot_de_passe, $pdo_options);
?>