<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Member;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
  //
  public function show_post()
  {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
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



    $cachedBlog = Redis::get('member' . $id);


    if (isset($cachedBlog)) {
      $member = json_decode($cachedBlog, FALSE);

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
}
