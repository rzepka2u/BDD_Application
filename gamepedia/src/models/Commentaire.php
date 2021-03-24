<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Commentaire extends Model {

    protected $table = 'commentaire';
    protected $primaryKey = 'id';

    public function Utilisateurs() {
        return $this->hasMany('gamepedia\models\Utilisateurs', 'email_utilisateur');
    }

    public function Game() {
        return $this->belongsToMany('gamepedia\models\Game', 'commentaire2game', 'id_commentaire', 'id_game');
    }
}