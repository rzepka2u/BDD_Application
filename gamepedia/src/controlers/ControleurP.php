<?php

namespace gamepedia\controlers;

use gamepedia\models\Character;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gamepedia\models\Game;
use gamepedia\models\Commentaire;

class ControleurP {
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function getJeuX(Request $request, Response $response, $args) : Response {

        $tmp=null;
        try {
            $tmp = Game::select('id', 'name', 'alias', 'deck', 'description', 'original_release_date') -> where('id', '=', $args['id']) -> firstOrFail() -> toArray();
        } catch (\Exception $e) {
            return $response->withJson(['error'=> "Jeu introuvable"], 404, JSON_PRETTY_PRINT);
        }

        $tab['games'] = $tmp;

        $tab['links']= ["comments" => ['href' => $this->container->router->pathFor("getCommentsJeuX", ['id' => $args['id']]) ]];
        $tab['links']+= ["characters" => ['href' => $this->container->router->pathFor("getCharactersJeuX", ['id' => $args['id']]) ]];

        return $response->withJson($tab, 200, JSON_PRETTY_PRINT);
    }

    public function getJeu200(Request $request, Response $response, $args) : Response {
        $page = (isset($_GET['page'])) ? $_GET['page'] : -1;

        if ($page <0) return $response->withJson(['error'=> "Page introuvable"], 404, JSON_PRETTY_PRINT);

        $tmp=null;

        try {
            $count = Game::count()/200;
            $count = round($count);
            if ($page>$count) throw new \Exception();

            $tmp = Game::select('id', 'name', 'alias', 'deck', 'description', 'original_release_date') -> skip($page*200) -> take(200) -> get() -> toArray();

        } catch (\Exception $e) {
            return $response->withJson(['error'=> "Page introuvable"], 404, JSON_PRETTY_PRINT);
        }

        $tab['games'] = $tmp;

        if ($page-1>=0) $prev = "?page=" . ($page-1);
        else $prev = "?page=0";

        if ($page+1<=$count) $next = "?page=" . ($page+1);
        else $next = "?page=" . $count;

        $tab['links'] = ["prev" => ["href" => $this->container->router->pathFor("getJeu200", ['page' => $page]) . $prev], "next" => ["href" => $this->container->router->pathFor("getJeu200", ['page' => $page+1]) . $next]];

        return $response->withJson($tab, 200, JSON_PRETTY_PRINT);
    }

    public function getCommentsJeuX(Request $request, Response $response, $args) : Response {

        $tmp=null;
        try {
            if (Game::find($args['id']) == null) throw new \Exception();

            $tmp = Commentaire::select('id', 'titre', 'contenu', 'created_at', 'email_utilisateur', 'created_at') -> whereHas('Game', function ($q) use ($args) {
                $q->where('id', '=', $args['id']);
            }) -> get() -> toArray();

        } catch (\Exception $e) {
            return $response->withJson(['error'=> "Jeu introuvable"], 404, JSON_PRETTY_PRINT);
        }

        $tab['commentaires'] = $tmp;

        return $response->withJson($tab, 200, JSON_PRETTY_PRINT);
    }

    public function getCharactersJeuX(Request $request, Response $response, $args) : Response {

        $tmp=null;
        try {
            if (Game::find($args['id']) == null) throw new \Exception();

            $tmp = Character::select('id', 'name') -> whereHas('Game', function ($q) use ($args) {
                $q->where('id', '=', $args['id']);
            }) -> get() -> toArray();

        } catch (\Exception $e) {
            return $response->withJson(['error'=> "Jeu introuvable"], 404, JSON_PRETTY_PRINT);
        }

        $tmpbis = null;
        $tmpquadris = [];
        foreach ($tmp as $character) {
            $id = $character['id'];
            $name = $character['name'];
            $tmpbis['character'] = ['id' => $id, 'name' => $name];
            $tmpbis['links'] = ["self" => $this->container->router->pathFor("getCharacterX", ['id' => $id])];

            array_push($tmpquadris,$tmpbis);
        }
        $tab['characters'] = $tmpquadris;

        return $response->withJson($tab, 200, JSON_PRETTY_PRINT);
    }


    public function getCharacterX(Request $request, Response $response, $args) : Response {

        $tmp=null;
        try {
          $tmp = Character::select('id', 'name', 'real_name', 'alias', 'gender', 'deck', 'description', 'first_appeared_in_game_id') -> where('id', '=', $args['id'])-> firstOrFail() -> toArray();

        } catch (\Exception $e) {
            return $response->withJson(['error'=> "Personnage introuvable"], 404, JSON_PRETTY_PRINT);
        }

        $tab['character'] = $tmp;

        return $response->withJson($tab, 200, JSON_PRETTY_PRINT);
    }

    public function newComment(Request $request, Response $response, $args) : Response {

    }

}