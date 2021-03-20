<?php

namespace App\Http\Controllers\AuthschControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class LolController extends Controller
{
    //
    public function kex()
    {
        return "kex";
    }
    public function kexx()
    {
        return view('authsch.lol');
    }

}
