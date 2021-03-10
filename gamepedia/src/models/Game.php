<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Game extends Model {

    protected $table = 'game';
    protected $primaryKey = 'id';

    public function Game(){
        return $this->belongsTo('gamepedia\models\Game','game_id');
    }

    public function Character() {
        return $this->belongsToMany('gamepedia\models\Character', 'game2character', 'game_id', 'character_id');
    }

    public function Publisher() {
        return $this->belongsToMany('gamepedia\models\Company', 'game_publishers', 'game_id', 'comp_id');
    }

    public function Developer() {
        return $this->belongsToMany('gamepedia\models\Company', 'game_developers', 'game_id', 'comp_id');
    }

    public function Rating() {
        return $this->belongsToMany('gamepedia\models\GameRating', 'game2rating', 'game_id', 'rating_id');
    }

    public function Genre() {
        return $this->belongsToMany('gamepedia\models\Game', 'game2genre', 'game_id', 'genre_id');
    }

}