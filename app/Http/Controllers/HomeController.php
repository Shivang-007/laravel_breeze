<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Member;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
use App\Exceptions\PostNotFoundException;



class HomeController extends Controller
{
  //
  public function show_post()
  {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
  }


  //serialization
  public function index(){
    //$user=Member::all()->toJson();
    $user=Member::all()->toArray();
    //$user=json_decode($user);
    var_dump($user);
    //return $user->toJson();
    //return $user->toArray();
    return view('serialize',['users'=>$user]);
  }



  //cache practice
  public function cache_store()
  {
    $member = DB::table('members')->get();
    $cache = Cache::forever('data', $member);
    //$cache=Cache::forget('data');
    if (Cache::has('data')) {
      $cache = Cache::get('data');
      return view('cacherecord', compact('cache'));
    } else {
      echo "cache not found";
    }
  }

  //redis
  public function redis($id)
  {
    // $redis= Redis::Connection();
    // $id=DB::table('members')->whereBetween('id',[20,30])->get();
    // $redis->set('name',$id, 'Taylor');
    // print_r($redis->get('name'));



    $cachedData = Redis::get('member' . $id);


    if (isset($cachedBlog)) {
      $member = json_decode($cachedData, FALSE);

      return response()->json([
        'status_code' => 201,
        'message' => 'Fetched from redis',
        'data' => $member,
      ]);
    } else {
      $member = Member::find($id);
      Redis::set('member' . $id, $member);

      return response()->json([
        'status_code' => 201,
        'message' => 'Fetched from database',
        'data' => $member,
      ]);
    }
  }


  public function redis_update(Request $request, $id) {

    $update = Member::findOrFail($id)->update($request->all());
  
    if($update) {
  
        // Delete member_$id from Redis
        Redis::del('member' . $id);
  
        $member = Member::find($id);
        // Set a new key with the member id
        Redis::set('member' . $id, $member);
  
        return response()->json([
            'status_code' => 201,
            'message' => 'User updated',
            'data' => $member,
        ]);
    }
  
  }

  public function redis_delete($id) {

    Member::findOrFail($id)->delete();
    Redis::del('member' . $id);
  
    return response()->json([
        'status_code' => 201,
        'message' => 'Blog deleted'
    ]);
  }

  public function exception(){
    try{
    $data=Member::where('id',70)->firstOrFail();
    return $data;
    }
    catch(\Exception $ex){
      dd(get_class($ex));
    }
  
  }
    
    
    public function getPost($id){
      try{
      $post=User::where('id',$id)->with('post')->firstOrFail();
      $post->load(['comment']);
      //return $post;
      }catch(\Exception $ex){
        //dd($ex->getMessage());           //this will return exception message
        //dd(get_class($ex));                //this will return exception class
         return "Post not found";
      }

      // $post=Post::where('id',$id)->with('post')->firstOrFail();
      // return $post;             //this will redirect 404 not found page

      // try{
      //   $post=User::where('id',$id)->with('post')->firstOrFail();
      //   return $post;
      //   }catch(\Exception $ex){
      //     throw new PostNotFoundException();
      //   }
      

    }

    //for practice accessors and mutetors
    public function postData(){
      $posts=Post::all();
      return $posts;
    }
    //casting
    public function userData(){
      $users=User::all();
      return $users;
    }

    public function softDelete()
    { 
        //  Member::where('id',57)->delete();
        //  $member = Member::get();     
        
        //$member =Member::withTrashed()->get();        //show all record with deleted record

        //$member =Member::onlyTrashed()->get();           //it will show only deleted data

       // $member = Member::where('id',57)->restore();    //to restore the perticular deleted data
        

        //$member =Member::onlyTrashed()->restore();     //restore all deleted records
      
        

         Member::where('id',57)->forceDelete();        //it will delete record permenently
         $member = Member::get();
        dd($member->toArray());

    }
}
