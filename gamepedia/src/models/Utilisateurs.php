<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model {

    protected $table = 'utilisateurs';
    protected $primaryKey = 'email';
    public $timestamps = false;

    public function Commentaire() {
        return $this->belongsTo('gamepedia\models\Commentaire', 'email_utilisateur');
    }
}