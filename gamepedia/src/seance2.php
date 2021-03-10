<?php

require '../vendor/autoload.php';

use gamepedia\bd\Requetes;

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../config/config.ini'));
$db->setAsGlobal();
$db->bootEloquent();

//Requetes::listerPersoJeu12342();
//Requetes::listerPersoJeuMario();
//Requetes::listerJeuSony();
//Requetes::listerRatingMario();
//Requetes::listerJeuMario3Perso();
//Requetes::listerJeuMarioRating();
//Requetes::listerJeuMarioCompInc();
//Requetes::listerJeuMarioCompIncRating3();

Requetes::nouveauGenreEtJeux();