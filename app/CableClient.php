<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CableClient extends Model
{
    protected $table ='cable_client';
    protected $primaryKey='clientId';
    public $timestamps = false;
}
