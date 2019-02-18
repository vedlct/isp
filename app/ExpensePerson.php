<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensePerson extends Model
{
    protected $table ='expense_person';
    protected $primaryKey='id';
    public $timestamps = false;
}
