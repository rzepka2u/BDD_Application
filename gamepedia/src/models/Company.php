<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Company extends Model {

    protected $table = 'company';
    protected $primaryKey = 'id';

    public function Company(){
        return $this->belongsTo('gamepedia\models\Company','company_id');
    }

    public function Publish() {
        return $this->belongsToMany('gamepedia\models\Game', 'game_publishers', 'comp_id', 'game_id');
    }

    public function Develop() {
        return $this->belongsToMany('gamepedia\models\Game', 'game_developers', 'comp_id', 'game_id');
    }

}