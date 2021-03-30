<?php

namespace gamepedia\controlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gamepedia\models\Game;

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
            $response->withStatus(404);
        }

        $tab['games'] = $tmp;

        $tab['links']= ["self" => $this->container->router->pathFor("getJeuX", ['id' => $args['id']])];

        $response->withHeader ('Content-Type', 'application/json');
        $response->write(json_encode($tab));
        return $response;
    }

    public function getJeu200(Request $request, Response $response, $args) : Response {
        $page = (isset($_GET['page']) && $_GET['page'] >= 0) ? $_GET['page'] : 1;
        $tmp=null;
        try {
            $tmp = Game::select('id', 'name', 'alias', 'deck', 'description', 'original_release_date') -> skip($page*200) -> take(200) -> get() -> toArray();
        } catch (\Exception $e) {
            $response->withStatus(404);
        }

        $tab['games'] = $tmp;

        /*
        $tab['links']= ["prev" => $this->container->router->pathFor("getJeu200", ['id' => $page-1])
            , "next" => $this->container->router->pathFor("getJeu200", ['id' => $page+1])];
        */

        $tab['links']= ["prev" => "/api/games?page=" . ($page-1)
            , "next" => "/api/games?page=" . ($page+1)];

        $response->withHeader ('Content-Type', 'application/json');
        $response->write(json_encode($tab));
        return $response;
    }

}