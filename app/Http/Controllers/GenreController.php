<?php

namespace App\Http\Controllers;

use App\Genre;

class GenreController extends Controller
{
    public function index(){

        return Genre::all();

    }
}
