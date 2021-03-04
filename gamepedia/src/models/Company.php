<?php
namespace gamepedia\models;

use \Illuminate\Database\Eloquent\Model;

class Company extends Model {

    protected $table = 'company';
    protected $primaryKey = 'id';

    public function Company(){
        return $this->belongsTo('gamepedia\models\Company','company_id');
    }

}