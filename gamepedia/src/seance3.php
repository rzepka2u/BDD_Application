<?php

require '../vendor/autoload.php';

use gamepedia\bd\Requetes;
use Illuminate\Database\Capsule\Manager as DB;

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../config/config.ini'));
$db->setAsGlobal();
$db->bootEloquent();
$db->getConnection()->enableQueryLog();

//Requetes::listerJeuX();

/* lister le nom des persos des jeux
 * Temps :
 * - Mario : 1.0286660194397 -> 0.97385382652283
 * - Sonic : 1.0235140323639 -> 1.0093958377838
 * - Luigi : 1.0065040588379 -> 0.13608694076538
 */

/** lister le nom des jeux
 * Temps :
 * - Mario : 0.16588306427002 -> 0.039772987365723
 * - Sonic : 0.15368700027466 -> 0.040035963058472
 * - Luigi : 0.14210796356201 -> 0.024783849716187
 */

//Requetes::listerJeuxContient();
/** lister le nom des jeux
 * Temps :
 * - Mario : 0.18530607223511 -> 0.17841220673401
 * - Sonic : 0.18903303146362 -> 0.16113710403442
 * - Luigi : 0.15472412109375 -> 0.14641308784485
 */

//Requetes::listerCompagniesPays();
/** lister le nom des compagnies
 * Temps :
 * - Japan : 0.16280198097229
 * - France : 0.050164937973022
 * - UK : 0.043662071228027
 *
 * INDEX on location_country actif
 *
 * - USA : 0.088282108306885
 * - Germany : 0.049126863479614
 * - United States : 0.10975098609924
 */

// PARTIE 2

//Requetes::listerJeuxContient(); // 1 requete : query : select * from `game` where `name` like ? --- bindings : [ %Mario%, ]

//Requetes::listerPersoJeu12342(); // 2 requetes en 1 : query : select `name`, `deck` from `character` where exists (select * from `game` inner join `game2character` on `game`.`id` = `game2character`.`game_id` where `character`.`id` = `game2character`.`character_id` and `id` = ?) --- bindings : [ 12342, ]

//Requetes::listerPersoJeuMario(); // 2 requetes en 1 : query : select * from `character` where exists (select * from `game` inner join `game2character` on `game`.`id` = `game2character`.`game_id` where `character`.`id` = `game2character`.`character_id` and `name` like ?) --- bindings : [ %Mario%, ]

//Requetes::listerJeuSony(); // 2 requetes en 1 : query : select * from `game` where exists (select * from `company` inner join `game_developers` on `company`.`id` = `game_developers`.`comp_id` where `game`.`id` = `game_developers`.`game_id` and `name` like ?) --- bindings : [ %Sony%, ]

//Requetes::listerPersoJeuMarioPasOpti(); // 2 requetes différentes :

/*
 * query : select * from `game` where `name` like ? --- bindings : [ %Mario%, ] ---
 * query : select `character`.*, `game2character`.`game_id` as `pivot_game_id`, `game2character`.`character_id` as `pivot_character_id` from `character` inner join `game2character` on `character`.`id` = `game2character`.`character_id` where `game2character`.`game_id` in (506, 750, 983, 1217, 1450, 2611, 2669, 3111, 3898, 3979, 4240, 4337, 4747, 4954, 5321, 5461, 5529, 5753, 5851, 5949, 6044, 6105, 6184, 6310, 6408, 6420, 6518, 6649, 6691, 6736, 6805, 6829, 6868, 6948, 7484, 7610, 7628, 8003, 8145, 8479, 9191, 9392, 9982, 10050, 10219, 11104, 11355, 11367, 11382, 11626, 11722, 12419, 12924, 13146, 13455, 13470, 13845, 14024, 14059, 14158, 14648, 15142, 15265, 16070, 16237, 16650, 16866, 17073, 17350, 17366, 17489, 17841, 17922, 17929, 18023, 18103, 18137, 18217, 18755, 18800, 18852, 19027, 19051, 19236, 19247, 19249, 19253, 20250, 20614, 20687, 20968, 21716, 22293, 22294, 22573, 22829, 22830, 22831, 22889, 22917, 23556, 23557, 24307, 24309, 24317, 24322, 24323, 24722, 24800, 26188, 26189, 27186, 27216, 27217, 27219, 27220, 27221, 27222, 27224, 27225, 27332, 28846, 28858, 28863, 28871, 29111, 31162, 31772, 31857, 31911, 32092, 32307, 32310, 33060, 34575, 35507, 35641, 37819, 37878, 37879, 37885, 38543, 38787, 39043, 39045, 41653, 42338, 42550, 42556, 42557, 42728, 44450, 44823, 45710, 45711, 45901, 45902, 47401) --- bindings : [ ] --- --------------
 */

Requetes::listerJeuSonyPasOpti(); // 2 requetes différentes :

/*
 * query : select * from `company` where `name` like ? --- bindings : [ %Sony%, ] ---
 * query : select `game`.*, `game_developers`.`comp_id` as `pivot_comp_id`, `game_developers`.`game_id` as `pivot_game_id` from `game` inner join `game_developers` on `game`.`id` = `game_developers`.`game_id` where `game_developers`.`comp_id` in (142, 362, 971, 1338, 2134, 3068, 3366, 4803, 4911, 6182, 6465, 8012, 11294) --- bindings : [ ] ---
 */

foreach( $db->getConnection()->getQueryLog() as $q){
    echo "-------------- \n";
    echo "query : " . $q['query'] ."\n";
    echo " --- bindings : [ ";
    foreach ($q['bindings'] as $b ) {
        echo " ". $b."," ;
    }
    echo " ] ---\n";
    echo "-------------- \n \n";
};