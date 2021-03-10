<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class GameRating extends Model {

    protected $table = 'game_rating';
    protected $primary_key = 'id';

    public function RatingBoard() {
        return $this->belongsTo('gamepedia\models\RatingBoard', 'rating_board_id');
    }

    public function Game() {
        return $this->belongsToMany('gamepedia\models\Game', 'game2rating', 'rating_id', 'game_id');
    }
}