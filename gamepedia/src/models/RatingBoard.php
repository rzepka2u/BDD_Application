<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class RatingBoard extends Model {

    protected $table = 'rating_board';
    protected $primary_key =  'id';

    public function Ratings() {
        return $this->hasMany('gamepedia\models\GameRating', 'rating_board_id');
    }
}