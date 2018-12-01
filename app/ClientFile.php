<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientFile extends Model
{
    protected $table ='client_files';
    protected $primaryKey='fileId';
    public $timestamps = false;
}
