<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myuser extends Model
{
    //
    protected $table='hello';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];
}
