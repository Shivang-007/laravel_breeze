<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Events\PostCreated;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        //
        $user=$req->user();
        $post=new Post;
        $post->title=$req->title;
        $post->body=$req->body;
        $user->post()->save($post);
        $data=['title'=>$post['title']];
        event(new PostCreated($data));
        return redirect(route('post_index'))->with('status','Post Added');
    }
    // public function event(){
    //     event(new PostCreated('Post is created'));
    // }

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::find($id);
        if(Gate::denies('isAdmin',$post)){
            abort(403);
        }
        return view('editpost',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $post=Post::find($id);
        $post->title=$req->title;
        $post->body=$req->body;
        $post->save();
        return redirect(route('dashboard'))->with('status','Post Updated');

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
        $post=Post::destroy($id);
        if(Gate::denies('isAdmin',$post)){
            abort(403);
        }
        return redirect(route('dashboard'))->with('status','Post deleted');

    }
}
