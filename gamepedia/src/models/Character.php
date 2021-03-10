<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Character extends Model {

    protected $table = 'character';
    protected $primaryKey = 'id';

    public function Game() {
        return $this->belongsToMany('gamepedia\models\Game', 'game2character', 'character_id', 'game_id');
    }
}