<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    protected $table ='package';
    protected $primaryKey='packageId';
    public $timestamps = false;
}
