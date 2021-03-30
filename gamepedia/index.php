<?php

session_start();

require 'vendor/autoload.php';

use gamepedia\controlers\ControleurP;

$config = ['settings' => [
    'displayErrorDetails' => true,
]];

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('config/config.ini'));
$db->setAsGlobal();
$db->bootEloquent();
$db->getConnection()->enableQueryLog();

$container = new \Slim\Container($config);
$app = new \Slim\App($container);

$app->get('/api/games/{id}', ControleurP::class.':getJeuX')->setName("getJeuX");
$app->get('/api/games', ControleurP::class.':getJeu200')->setName("getJeu200");


$app->run();