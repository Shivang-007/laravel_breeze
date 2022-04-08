<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\userFollowNotification;
use APp\Models\User;

class NotificationController extends Controller
{
    //
    public function databaseNotification(){

        // if(auth()->user()){
        // $user = User::whereId(4)->first();
        // auth()->user()->notify(new userFollowNotification($user));
        // }    
    }
}
