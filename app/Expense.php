<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $table ='expense';
    protected $primaryKey='expenseId';
    public $timestamps = false;
}
