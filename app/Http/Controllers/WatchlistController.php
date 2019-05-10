<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Watchlist;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return $user->watchlists;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = auth()->id();

        $watclist = new Watchlist([
            'user_id' => $id,
            'name' => $request->get('name')
        ]);

        $watclist->save();

        return $watclist;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function show(Watchlist $watchlist)
    {
        $user = auth()->user();

        if(auth()->id() == $watchlist->user_id) {
            return $user->watchlists->find($watchlist->id)->load('movies');
        }else{
            throw new UnauthorizedException('Cant access this watchlist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Watchlist $watchlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watchlist $watchlist)
    {

        $movieId = $request->id;

        if(auth()->id() == $watchlist->user_id) {
            if (!$watchlist->movies()->find($movieId)) {
                $watchlist->movies()->attach($movieId);
            }else{
                throw new ValidationException('Movie already in watchlist');
            }
        }else{
            throw new UnauthorizedException('Cant access this watchlist');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watchlist $watchlist)
    {

    }

    public function destroyMovieFromWatchlist(Watchlist $watchlist, Movie $movie){


        if(auth()->id() == $watchlist->user_id) {
                $watchlist->movies()->detach($movie->id);
        }else{
            throw new UnauthorizedException('Cant remove from this watchlist');
        }
    }
}
