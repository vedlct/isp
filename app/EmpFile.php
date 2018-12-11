<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpFile extends Model
{
    protected $table ='emp_files';
    protected $primaryKey='fileId';
    public $timestamps = false;
}
