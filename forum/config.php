<?php
/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que le
forum puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
mysql_connect('mysql0.db.koding.com', 'ageofsurvival_fi', 'TrMTbR1_HedCYiBeLuvu4UvWAJLPLzKj8y12ZDhu');
mysql_select_db('ageofsurvival_fi');

//Nom dutilisateur de ladministrateur
$admin='Geekstory';

/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';

//Nom du design
$design = 'default';


/******************************************************
----------------------Initialisation-------------------
******************************************************/
include('init.php');
?>