<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PostcardComment extends Model {

    protected $fillable = ['name', 'content', 'postcard_id'];
}
