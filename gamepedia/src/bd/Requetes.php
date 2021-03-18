<?php

namespace gamepedia\bd;

use gamepedia\models\Company;
use gamepedia\models\Game;
use gamepedia\models\Character;
use gamepedia\models\Genre;
use gamepedia\models\RatingBoard;
use gamepedia\models\GameRating;
use gamepedia\models;

class Requetes {

    public static function listerPersoJeu12342() {
        $perso = Character::select('name', 'deck') -> whereHas('game', function ($q) {
            $q->where('id', '=', 12342);
        }) -> get() -> toArray();

        echo "(name , deck) des personnages du jeu 12342 : <br> <br>";
        foreach ($perso as $g) {
            echo "Name : " . $g['name'] . " | Deck : " . $g['deck'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function listerPersoJeuMario() {
        $tmp1 = microtime(true);
        $perso = Character::whereHas('game', function ($q) {
            $q->where('name', 'like', 'Mario%');
        }) -> get() -> toArray();
        $tmp2 = microtime(true);

        echo "personnages des jeux débutant par Mario : <br> <br>";
        foreach ($perso as $g) {
            echo "Name : " . $g['name'] . "<br>";
        }
        echo "temps d'éxecution : " . $tmp2-$tmp1;
        echo "FIN <br> <br>";
    }

    public static function listerJeuSony() {
        $jeu = Game::whereHas('developer', function ($q) {
            $q->where('name', 'like', '%Sony%');
        }) -> get() -> toArray();

        echo "jeu développés par Sony : <br> <br>";
        foreach ($jeu as $g) {
            echo "Name : " . $g['name'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function listerRatingMario() {
        $tmp1 = microtime(true);
        $jeu = GameRating::whereHas('game', function ($q) {
            $q->where('name', 'like', '%Mario%');
        }) -> get() -> toArray();
        $tmp2 = microtime(true);

        echo "rating initial des jeux dont le nom contient Mario : <br> <br>";
        foreach ($jeu as $g) {
            echo "Rating : " . $g['name'] . "<br>";
        }
        echo "temps d'éxécution : " . $tmp2-$tmp1 ;
        echo "FIN <br> <br>";
    }

    public static function listerJeuMario3Perso() {
        $jeu = Game::where('name', 'like', 'Mario%')->Has('character', '>', 3)-> get() -> toArray();

        echo "jeu développés par Sony : <br> <br>";
        foreach ($jeu as $g) {
            echo "Name : " . $g['name'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function listerJeuMarioRating() {
        $tmp1 = microtime(true);
        $jeu = Game::where('name', 'like', 'Mario%')->whereHas('rating', function($q) {
            $q->where('name', 'like', '%3+%');
        })-> get() -> toArray();
        $tmp2 = microtime(true);

        echo "jeux dont le nom commence par Mario et dont le rating initial contient 3+ : <br> <br>";
        foreach ($jeu as $g) {
            echo "Name : " . $g['name'] . "<br>";
        }
        echo "temps d'éxecution : " . $tmp2-$tmp1;
        echo "FIN <br> <br>";
    }

    public static function listerJeuMarioCompInc() {
        $jeu = Game::where('name', 'like', 'Mario%') -> whereHas('publisher', function ($q) {
            $q->where('name', 'like', '%Inc.%');
        })  ->whereHas('rating', function($q) {
            $q->where('name', 'like', '%3+%');
        })-> get() -> toArray();

        echo "jeux dont le nom commence par Mario, par une compagnie avec Inc. dans le nom et dont le rating initial contient 3+ : <br> <br>";
        foreach ($jeu as $g) {
            echo "Name : " . $g['name'] . "<br>";
        }
        echo "FIN <br> <br>";
    }

    public static function listerJeuMarioCompIncRating3() {
        $jeu = Game::where('name', 'like', 'Mario%')->whereHas('publisher', function($q) {
            $q->where('name', 'like', '%Inc%');
        })->whereHas('rating', function($q) {
            $q->where('name', 'like', '%3+%')->whereHas('ratingboard', function($q){
                $q->where('name', '=', 'CERO');
            });})
            ->get()->toArray();

            echo "jeux dont le nom commence par Mario, publiés par une compagnie dont le nom contient contient Inc, dont le rating contient 3+ et ayant reçu un avis du rating board nommé CERO : <br> <br>";
            foreach ($jeu as $g) {
                echo "Name : " . $g['name'] . "<br>";
            }
            echo "FIN <br> <br>";
    }

    public static function nouveauGenreEtJeux() {
        $g = new Genre();
        $g->name = 'Nouveau';
        $g->deck = 'Nouveau genre';
        $g->description = 'Nouveau Genre !';
        $g->save();

        $g->Game()->attach([12,56,345]);
    }
}
