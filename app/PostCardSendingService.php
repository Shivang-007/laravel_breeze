<?php

namespace App;
use Illuminate\Support\Facades\Mail;

class PostCardSendingService
{
    public function __construct($country, $height, $width)
    {
        $this->country=$country;
        $this->height=$height;
        $this->width=$width;
    }

    public function hello($message, $email){
        Mail::raw($message, function($message) use ($email){
            $message->to($email);
        });


        dump('postcard send with the message:' .$message);
    }
}