<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Movie extends Model
{
    protected $fillable = [
        'likes', 'dislikes'
    ];

    public function users(){

        return $this->belongsToMany('App\User', 'movies_users', 'movies_id', 'user_id');

    }
}
