<?php

require '../vendor/autoload.php';

use gamepedia\bd\Requetes;

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../config/config.ini'));
$db->setAsGlobal();
$db->bootEloquent();

//Requetes::listerJeuxMario();

//Requetes::listerCompagniesJapon();

//Requetes::listerPlatformeSup10000000();

//Requetes::lister442jeux();

//Requetes::listerJeux();

Requetes::listerJeuxPar500($_GET);