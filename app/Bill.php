<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table ='bill';
    protected $primaryKey='billId';
    public $timestamps = false;
}
