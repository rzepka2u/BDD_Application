<?php

namespace gamepedia\bd;

use gamepedia\models\Company;
use gamepedia\models\Game;
use gamepedia\models\Platform;

class Requetes {


    public static function listerJeuxMario() {
       $games = Game::select('id', 'name') -> where('name', 'LIKE', "%mario%") -> get() -> toArray();

        echo "Liste des jeux dont le nom contient 'Mario' : <br> <br>";
        foreach ($games as $g) {
            echo "ID : " . $g['id'] . " | NAME : " . $g['name'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function listerCompagniesJapon() {
        $companies = Company::select('id', 'name') -> where('location_country', 'LIKE', "%japan%") -> get() -> toArray();

        echo "Liste des compagnies installées au Japon : <br> <br>";
        foreach ($companies as $c) {
            echo "ID : " . $c['id'] . " | NAME : " . $c['name'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function listerPlatformeSup10000000() {
        $platforms = Platform::select('id', 'name', 'install_base') -> where('install_base', '>=', 10000000) -> get() -> toArray();

        echo "Liste des plateformes dont la base installée est >= 10 000 000 : <br> <br>";
        foreach ($platforms as $c) {
            echo "ID : " . $c['id'] . " | NAME : " . $c['name'] . " | Base installee : " . $c['install_base'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function lister442jeux() {
        $games = Game::select('id', 'name') -> where('id', '>=', 21173) -> limit(442) -> get() -> toArray();

        echo "Liste de 442 jeux à partir du 21173ème : <br> <br>";
        foreach ($games as $c) {
            echo "ID : " . $c['id'] . " | NAME : " . $c['name'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function listerJeuxPagi() {
        $games = Game::select('id', 'name', 'deck') -> get() -> toArray();

        echo "Liste des jeux, afficher leur nom et deck, en paginant (taille des pages : 500) : <br> <br>";
        foreach ($games as $c) {
            echo "ID : " . $c['id'] . " | NAME : " . $c['name'] . " | Deck : " . $c['deck'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

}
