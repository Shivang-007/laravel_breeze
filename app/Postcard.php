<?php

namespace App;

class Postcard
{
     protected static function resolveFacade($name)
     {
         return app()[$name];
     }



     public static function __callStatic($method, $arguments)
     {
         
          dd(self::resolveFacade('Postcard')->$method(...$arguments));
     }

    //  public function any(){
    //      dump('inside');
    //  }
}