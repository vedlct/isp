<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table ='report';
    protected $primaryKey='reportId';
    public $timestamps = false;
}
