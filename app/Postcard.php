<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Postcard extends Model {

	public function hasManyComments()
    {
        return $this->hasMany('App\PostcardComment', 'postcard_id', 'id');
    }
    public function hasManyDemands()
    {
        return $this->hasMany('App\Exchange', 'postcard_id', 'demand_user');
    }
}