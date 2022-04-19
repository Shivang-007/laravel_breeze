<?php

namespace App\Exceptions;

use Exception;

class PostNotFoundException extends Exception
{
    //
    public function render(){
        return view('post-exceptoion');
    }
}
