<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     protected $table = 'book';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
