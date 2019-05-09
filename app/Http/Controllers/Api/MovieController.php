<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        views($movie)->record();

        $movie->update([
            'times_visited' => $movie->times_visited+1
        ]);

        return $movie->load('comments');
    }

    public function getCommentsForMovie(Movie $movie){

        return $movie->comments;

    }

    public function update(Request $request, Movie $movie){

        $movie->update($request->all());

        $movie->save();

        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLikeDislike(Request $request, Movie $movie)
    {
        $user = auth()->user();

        if (!$user->movies()->find($movie->id)) {
            $movie->update($request->all());

            $movie->save();

            $user->movies()->attach($movie);

            return $movie;
        }else{
            throw new ValidationException('Already voted');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
