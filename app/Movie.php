<?php

namespace App;

use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use CyrildeWit\EloquentViewable\Viewable;
use Illuminate\Database\Eloquent\Model;


class Movie extends Model implements ViewableContract
{
    use Viewable;

    protected $fillable = [
        'likes', 'dislikes', 'timesVisited'
    ];

    public function users(){

        return $this->belongsToMany('App\User', 'movies_users', 'movies_id', 'user_id');

    }

    public function comments(){

        return $this->hasMany(Comment::class);

    }

}
