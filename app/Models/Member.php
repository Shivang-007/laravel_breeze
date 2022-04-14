<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table="members";
    public $fillable=[
        "name",
        "email"
    ];
    protected $hidden=[
        'email',
        
    ];
    protected $visible=[
        'name'
    ];
}