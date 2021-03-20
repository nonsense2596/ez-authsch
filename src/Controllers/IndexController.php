<?php

namespace App\Http\Controllers\Authsch;

use Illuminate\Http\Request;
use App\Models\User;    // talan nem kell
use App\Http\Controllers\Controller as Controller;

class IndexController extends Controller
{
    public function index(){
        // a controller nem szükséges ahhoz, hogy DB-ben  turkáljunk TIL
//        User::create([
//            'name' => 'Akariii'
//        ]);
        return view("authsch.index");
    }
}
