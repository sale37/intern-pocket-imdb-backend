<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $fillable = [
        'user_id', 'name'
    ];

    public function user()
    {

        $this->belongsTo(User::class);

    }

    public function movies()
    {

        return $this->belongsToMany('App\Movie', 'watchlist_movie', 'watchlist_id', 'movie_id')->withPivot('watched');

    }
}
