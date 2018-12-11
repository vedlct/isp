<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
    protected $table ='salary';
    protected $primaryKey='id';
    public $timestamps = false;
}
