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

    protected $appends = ['is_watched'];

    public function users(){

        return $this->belongsToMany('App\User', 'movies_users', 'movies_id', 'user_id');

    }

    public function comments(){

        return $this->hasMany(Comment::class);

    }

    public function watchlists(){

        return $this->belongsToMany('App\Watchlist', 'watchlist_movie', 'movie_id', 'watchlist_id')->withPivot('watched');

    }

    public function getIsWatchedAttribute(){

        foreach ($this->watchlists as $watchlsit)

        return $watchlsit->pivot->watched;

    }

    public function genre(){

        return $this->belongsTo(Genre::class);

    }

}
