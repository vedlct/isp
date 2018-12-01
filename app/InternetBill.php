<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternetBill extends Model
{
    //
    protected $table ='internet_bill';
    protected $primaryKey='billId';
    public $timestamps = false;
}
