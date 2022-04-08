<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DeshboardController extends Controller
{
    //
    public function show_post(Request $req){
          //$posts=Post::all();
          $userid=$req->user()->id;
          $posts=Post::where('user_id',$userid)->get();
          return view('dashboard',['posts'=>$posts]);
    }
}
