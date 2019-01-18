<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsConfig extends Model
{
    //
    protected $table ='sms_config';
    protected $primaryKey='id';
    public $timestamps = false;
}
