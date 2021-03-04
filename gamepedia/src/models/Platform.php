<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Platform extends Model {

    protected $table = 'platform';
    protected $primaryKey = 'id';

    public function Platform(){
        return $this->belongsTo('gamepedia\models\Platform','platform_id');
    }

}