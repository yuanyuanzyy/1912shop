<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
     protected $table = 'car';
    protected $primaryKey = 'car_id';
   
    //黑名单
    protected $guarded=[];
}
