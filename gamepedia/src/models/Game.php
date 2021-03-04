<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Game extends Model {

    protected $table = 'game';
    protected $primaryKey = 'id';

    public function Game(){
        return $this->belongsTo('gamepedia\models\Game','game_id');
    }

}