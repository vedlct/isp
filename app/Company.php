<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table ='isp_info';
    protected $primaryKey='id';
    public $timestamps = false;
}
