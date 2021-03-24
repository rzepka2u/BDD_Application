<?php

require '../vendor/autoload.php';

use gamepedia\bd\Requetes;
use Illuminate\Database\Capsule\Manager as DB;
use \gamepedia\models\Utilisateurs as Utilisateurs;
use \gamepedia\models\Commentaire as Commentaire;

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../config/config.ini'));
$db->setAsGlobal();
$db->bootEloquent();
$db->getConnection()->enableQueryLog();

/*
$us1 = new Utilisateurs();
$us1->email = 'user1@gmail.com';
$us1->nom = 'nUser1';
$us1->prenom = 'pUser1';
$us1->adresse = 'adresse1';
$us1->telephone = '923884727489';
$us1->date_naissance = new DateTime("03-03-1998");
$us1->save();*/
/*
$us2 = new Utilisateurs();
$us2->email = 'user2@gmail.com';
$us2->nom = 'nUser2';
$us2->prenom = 'pUser2';
$us2->adresse = 'adresse2';
$us2->telephone = '39874390';
$us2->date_naissance = new DateTime("04-04-1994");
$us2->save();*/

/*
$cm1 = new Commentaire();
$cm1->email_utilisateur = 'user1@gmail.com';
$cm1->titre = 'Titre1';
$cm1->contenu = 'ContenuContenuContenuContenu1';
$cm1->save();

$cm2 = new Commentaire();
$cm2->email_utilisateur = 'user1@gmail.com';
$cm2->titre = 'Titre2';
$cm2->contenu = 'ContenuContenuContenuContenu2';
$cm2->save();

$cm3 = new Commentaire();
$cm3->email_utilisateur = 'user1@gmail.com';
$cm3->titre = 'Titre3';
$cm3->contenu = 'ContenuContenuContenuContenu3';
$cm3->save();

$cm1->Game()->attach(12342);
$cm2->Game()->attach(12342);
$cm3->Game()->attach(12342);*/

/*
$cm1 = new Commentaire();
$cm1->email_utilisateur = 'user2@gmail.com';
$cm1->titre = 'Titre1';
$cm1->contenu = 'ContenuContenuContenuContenu1';
$cm1->save();

$cm2 = new Commentaire();
$cm2->email_utilisateur = 'user2@gmail.com';
$cm2->titre = 'Titre2';
$cm2->contenu = 'ContenuContenuContenuContenu2';
$cm2->save();

$cm3 = new Commentaire();
$cm3->email_utilisateur = 'user2@gmail.com';
$cm3->titre = 'Titre3';
$cm3->contenu = 'ContenuContenuContenuContenu3';
$cm3->save();

$cm1->Game()->attach(12342);
$cm2->Game()->attach(12342);
$cm3->Game()->attach(12342);*/


            //$faker = Faker\Factory::create();
/*
$i = 0;
while ($i < 25000) {
    $us = new Utilisateurs();

    $us->nom = $faker->lastName();
    $us->prenom = $faker->firstName();
    $us->adresse = $faker->address();
    $us->telephone = $faker->phoneNumber();
    $us->date_naissance = $faker->dateTime();

    $us->email = $us->prenom . '.' . $us->nom . $i . '@' . $faker->domainName() ;

    $us->save();
    $i++;
}*/


/*foreach(Requetes::utilisateurs() as $utilisateur) {
    for($i=0; $i<10; $i++) {
        $cm1 = new Commentaire();
        $cm1->email_utilisateur = $utilisateur->email;
        $cm1->titre = $faker->word();
        $cm1->contenu = $faker->sentence();
        $cm1->save();
    }
}*/
/*
foreach(Requetes::commentaires() as $commentaire) {
    $id = random_int(0, 47948);
    $commentaire->Game()->attach($id);
}*/

//Requetes::listerCommentaireUtilisateur("Aaliyah.Boehm1224@okeefe.com");

Requetes::Utilisateurs5Commentaires();
