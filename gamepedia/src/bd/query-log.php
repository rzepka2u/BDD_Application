<?php
/**
 * File:  1.php
 * Creation Date: 04/01/2016
 * description:
 *
 * @author: canals
 */

require '../vendor/autoload.php';

use \games\model\Game;
use \games\model\Company;
use \games\model\Platform;
use \games\model\Character;

use Illuminate\Database\Capsule\Manager as DB;


/**
 *   configurer la connexion à la base  ...
 */
/*
 * logging des requêtes
 * activer le logging
 * exécuter les requêtes
 * afficher le log
 */

DB::connection()->enableQueryLog();

/**
 *  les jeux dont le nom contient Mario
 */

Game::where('name', 'like', '%Mario%')->get();

/*
 * nom des persos du jeu 12342
 */

foreach (Game::find(12342)->characters as $c)
    echo "- perso : " . $c->name ."\n";


/**
 * affichage du log de requêtes
 */

foreach( DB::getQueryLog() as $q){
    echo "-------------- \n";
    echo "query : " . $q['query'] ."\n";
    echo " --- bindings : [ ";
    foreach ($q['bindings'] as $b ) {
        echo " ". $b."," ;
    }
    echo " ] ---\n";
    echo "-------------- \n \n";
};

