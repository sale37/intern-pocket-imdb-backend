<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'author', 'comment', 'movie_id'
    ];

    public function movie(){

        return $this->belongsTo(Movie::class);

    }
}
