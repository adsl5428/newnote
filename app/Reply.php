<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table='replys';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];
}
