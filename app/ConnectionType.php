<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectionType extends Model
{
    protected $table ='connectiontype';
    protected $primaryKey='connectionTypeId';
    public $timestamps = false;
}
