<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalExpense extends Model
{
    protected $table ='personal_expense';
    protected $primaryKey='id';
    public $timestamps = false;
}
