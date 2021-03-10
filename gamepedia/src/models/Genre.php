<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Genre extends Model {

    protected $table = 'genre';
    protected $primary_key = 'id';

    public function Game() {
        return $this->belongsToMany('gamepedia\models\Game', 'game2genre', 'genre_id', 'game_id');
    }
}