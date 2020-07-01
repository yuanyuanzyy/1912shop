<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
   // protected $table = 'members';
    protected $primaryKey = 'm_id';
   // public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
