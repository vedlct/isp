<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternetClient extends Model
{

    protected $table ='internet_client';
    protected $primaryKey='clientId';
    public $timestamps = false;
}
