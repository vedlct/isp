<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsCheckMonth extends Model
{
    //
    protected $table ='sms_checkmonth';
    protected $primaryKey='id';
    public $timestamps = false;
}
