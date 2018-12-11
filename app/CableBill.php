<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CableBill extends Model
{
    //
    protected $table ='cable_bill';
    protected $primaryKey='billId';
    public $timestamps = false;
}
